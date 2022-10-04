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
use App\Models\Market\CommonDiscount;

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
        $user= auth()->user();
        $cartItems = CartItem::where('user_id',$user->id)->get();

        //calculate price

        $totalProductPrice=0;
        $totalDiscount=0;
        $totalFinalPrice=0;
        $totalFinalDiscountPriceWithNumbers=0;

        foreach ($cartItems as $cartItem) {

            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscount += $cartItem->cartItemProductDiscount();
            $totalFinalPrice += $cartItem->cartItemFinalPrice();
            $totalFinalDiscountPriceWithNumbers += $cartItem->cartItemFinalDiscount();
        }


        //common discount

        $commonDiscount = CommonDiscount::where([['status',1] , ['start_date' , '<' , now()] , ['end_date' , '>' , now()] ])->first();

        if($commonDiscount)
        {
            $commonDiscountPercentageAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);

            if($commonDiscountPercentageAmount > $commonDiscount->discount_ceiling)
            {
                $commonDiscountPercentageAmount = $commonDiscount->discount_ceiling;
            }

            if($commonDiscount!==null && $totalFinalPrice >= $commonDiscount->minimal_order_amount)
            {
                $finalPrice = $totalFinalPrice - $commonDiscountPercentageAmount;

            }else{

                $finalPrice = $totalFinalPrice;
            }

            $inputs['common_discount_id'] = $commonDiscount->id;

        }else{

           // $commonDiscount->id == null;
            $finalPrice = $totalFinalPrice;
            $commonDiscountPercentageAmount = 0;
        }


        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['order_final_amount'] = $finalPrice;
        $inputs['order_discount_amount'] = $totalFinalDiscountPriceWithNumbers;
     //   $inputs['common_discount_id'] = $commonDiscount->id;
        $inputs['order_common_discount_amount'] = $commonDiscountPercentageAmount;
        $inputs['order_total_products_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_common_discount_amount'];


        Order::updateOrCreate(

            ['user_id'=>$user->id , 'order_status'=>0],
            $inputs
        );

        return redirect()->route('customer.sales-process.payment');
    }
}
