<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\ProfileCompletionRequest;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{

    public function profileCompletion()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
       return view('customer.sales-process.profile-completion',compact('user','cartItems'));
    }

    public function update(ProfileCompletionRequest $request)
    {

       $user=Auth::user();

       $national_code = convertPersianToEnglish($request->national_code);
       $national_code = convertArabicToEnglish($national_code);


       $inputs = [
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'national_code'=>$national_code
       ];


      if(isset($request->mobile) && empty($user->mobile))
      {
        if(preg_match('/^(\+98|98|0)9\d{9}$/',$request->mobile))
        {
            $type = 0; // 0 => mobile

            $mobile = convertPersianToEnglish($request->mobile);
            $mobile = convertArabicToEnglish($mobile);

            //all mobile number are in one format 9*********

            $mobile = ltrim($mobile,0);
            $mobile = substr($mobile,0,2) == '98' ? substr($mobile,2) : $mobile;
            $mobile = str_replace('+98' , '' ,$mobile);

            $inputs['mobile'] = $mobile;


        }else
        {
            $errorText=' شماره موبایل وارد شده معتبر نیست';

            return back()->withErrors(['mobile'=>$errorText]);
        }

      }

      if(isset($request->email) && empty($user->email))
      {

        $email = convertPersianToEnglish($request->email);
        $email = convertArabicToEnglish($email);
        $inputs['email'] = $email;
      }

      $inputs = array_filter($inputs);

      if(!empty($inputs))
      {
        $user->update($inputs);
      }

       return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
