<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Message\SMS\SmsService;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\Message\MessageService;

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
            $messageService->send();
        }
    }
}
