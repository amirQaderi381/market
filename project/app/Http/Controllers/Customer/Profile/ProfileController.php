<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function profile()
    {
        return view('customer.profile.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $inputs=[

            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'national_code'=>$request->national_code
        ];

        $user = auth()->user();
        $user->update($inputs);

        return redirect()->route('customer.profile.profile')->with('toast-success','حساب کاربری شما با موفقیت ویرایش شد');
    }
}
