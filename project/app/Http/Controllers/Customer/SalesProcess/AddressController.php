<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\City;
use App\Models\Address;
use App\Models\Province;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Models\Market\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\SalesProcess\StoreAddressRequest;
use App\Http\Requests\Customer\SalesProcess\UpdateAddressRequest;
use App\Http\Requests\Customer\SalesProcess\ChooseAddressAndDeliveryRequest;

class AddressController extends Controller
{

    public function addressAndDelivery()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
        $provinces = Province::all();
        $deliveryMethods = Delivery::where('status',1)->get();

        if(empty(CartItem::where('user_id',$user->id)->count()))
        {
            return redirect()->route('customer.salesProcess.cart');
        }


        return view('customer.sales-process.addressAndDelivery',compact('cartItems','provinces','deliveryMethods'));

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
        $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
        $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
        Address::create($inputs);
        return back()->with('swal-success','آدرس جدید شما با موفقیت ثبت شد');
    }

    public function updateAddress(Address $address, UpdateAddressRequest $request)
    {
       $inputs = $request->all();
       $inputs['user_id'] = Auth::user()->id;
       $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
       $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
       $address->update($inputs);
       return back()->with('toast-success','آدرس شما با موفقیت ویرایش شد');

    }

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
    {
        $inputs = $request->all();

        Order::updateOrCreate(

            ['user_id'=>auth()->user()->id , 'order_status'=>0],
            $inputs
        );

        return redirect()->route('customer.sales-process.payment');
    }
}
