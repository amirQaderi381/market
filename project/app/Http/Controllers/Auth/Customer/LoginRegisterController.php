<?php

namespace App\Http\Controllers\Auth\Customer;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        //check id is email or not

        if(filter_var($inputs['id'],FILTER_VALIDATE_EMAIL))
        {
            $type = 1; //1=>email
            $user = User::where('email',$inputs['id'])->first();
            if(empty($user))
            {
                $newUser['email'] = $inputs['id'];
            }
        }
        //check id is phone number or not

        elseif(preg_match('/^(\+98|98|0)9\d{9}$/',$inputs['id']))
        {
            $type = 0; //0=>phone number

            // all phone numbers are in one format 9** *** ***

            $inputs['id'] = ltrim($inputs['id'],0);
            $inputs['id'] = substr($inputs['id'],0,2) === '98' ? substr($inputs['id'],2) : $inputs['id'];
            $inputs['id'] = str_replace('+98','',$inputs['id']);

            $user = User::where('mobile',$inputs['id'])->first();
            if(empty($user))
            {
                $newUser['mobile'] = $inputs['id'];
            }

        }
        else{

            $error_message='شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>$error_message]);
        }

        if(empty($user))
        {
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user= User::create($newUser);
        }

        //create otp code

        $otpCode = rand(111111,999999);
        $token = Str::random(60);
        $otpInputs = [
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$inputs['id'],
            'type'=>$type
        ];

        Otp::create($otpInputs);

        //send sms or email

        if($type == 0){

            //send sms

            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(["0".$user->mobile]);
            $smsService->setIsFlash(true);
            $smsService->setText("مجمموعه آمازون \n کد تایید شما : {$otpCode}");

            $messageService = new MessageService($smsService);

        }elseif($type == 1)
        {
            //send email

            $details =[
                'title'=>'ایمیل فعالسازی',
                'body'=>"کد تایید شما : $otpCode"
            ];

            $emailService = new EmailService();
            $emailService->setSubject('کد تایید احراز هویت');
            $emailService->setDetails($details);
            $emailService->setFrom('no-reply@example.com','example');
            $emailService->setTo($user->email);
            $messageService = new MessageService($emailService);
        }

        $messageService->send();
        return redirect()->route('auth.customer.login-confirm-form',$token);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token',$token)->first();
        if(empty($otp))
        {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>'آدرس وارد شده معتبر نیست']);
        }
        return view('customer.auth.login-confirm',compact('token','otp'));
    }

    public function loginConfirm(LoginRegisterRequest $request,$token)
    {
       $inputs = $request->all();
       $otp = Otp::where('token',$token)->where('used',0)->where('created_at','>=',Carbon::now()->subMinutes(2)->toDateString())->first();

       if(empty($otp))
       {
          return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>'آدرس وارد شده معتبر نیست']);
       }

       //if otp not match

       if($otp->otp_code !== $inputs['otp'])
       {
        return redirect()->route('auth.customer.login-confirm-form')->withErrors(['id'=>'کد تایید وارد شده معتبر نیست']);
       }

       // if everything is ok :

        $otp->update(['used'=>1]);
        $user = $otp->user()->first();

        if($otp->type == 0 && empty($user->mobile_verified_at))
        {
            $user->update(['mobile_verified_at'=>Carbon::now()]);

        }elseif($otp->type == 1 && empty($user->email_verified_at))
        {
            $user->update(['email_verified_at'=>Carbon::now()]);
        }

        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function LoginResendOtp($token)
    {
        $otp = Otp::where('token',$token)->where('created_at','<=',Carbon::now()->subMinutes(2))->first();

        if(empty($otp))
        {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>'آدرس وارد شده معتبر نیست']);
        }

        $otpCode = Rand(111111,999999);
        $token = Str::random(60);
        $user = $otp->user()->first();

        $otpInputs = [
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$otp->login_id,
            'type' => $otp->type,
        ];

        Otp::create($otpInputs);

        if($otp->type == 0)
        {
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(["0".$user->mobile]);
            $smsService->setIsFlash(true);
            $smsService->setText("مجمموعه آمازون \n کد تایید شما : {$otpCode}");

            $messageService = new MessageService($smsService);

        }elseif($otp->type == 1)
        {
            $details =[
                'title'=>'ایمیل فعالسازی',
                'body'=>"کد تایید شما : $otpCode"
            ];

            $emailService = new EmailService();
            $emailService = new EmailService();
            $emailService->setSubject('کد تایید احراز هویت');
            $emailService->setDetails($details);
            $emailService->setFrom('no-reply@example.com','example');
            $emailService->setTo($otp->login_id);
            $messageService = new MessageService($emailService);

        }

        $messageService->send();
        return redirect()->route('auth.customer.login-confirm-form',$token);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.customer.login-register-form');
    }
}
