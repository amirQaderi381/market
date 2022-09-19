<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function addressAndDelivery()
    {
        //check profile
        $user = Auth::user();
        if(empty($user->first_name) || empty($user->last_name) || empty($user->national_code) || empty($user->mobile) || empty($user->email))
        {
            return redirect()->route('customer.sales-process.profile-completion');
        }


    }

    public function address()
    {

    }
}
