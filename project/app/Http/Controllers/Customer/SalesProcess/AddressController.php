<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function addressAndDelivery()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
        $provinces = Province::all();

        if(empty(CartItem::where('user_id',$user->id)->count()))
        {
            return redirect()->route('customer.salesProcess.cart');
        }


        return view('customer.sales-process.addressAndDelivery',compact('cartItems','provinces'));

    }


    public function getCities(Province $province)
    {
        $cities = $province->cities()->get();

        if($cities !== null)
        {
            return response()->json(['status'=>true , 'cities'=>$cities]);

        }else{

            return response()->json(['status'=>false , 'cities'=>null]);
        }
    }

    public function address(StoreAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        Address::create($inputs);
        return back()->with('swal-success','آدرس جدید شما با موفقیت ثبت شد');
    }
}
