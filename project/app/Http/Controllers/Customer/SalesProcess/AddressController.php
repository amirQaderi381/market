<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function addressAndDelivery()
    {

        if(empty(CartItem::where('user_id',Auth::user()->id)->count()))
        {
            return redirect()->route('customer.salesProcess.cart');
        }


    }

    public function address()
    {

    }
}
