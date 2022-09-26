<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;


class PaymentController extends Controller
{
    public function payment()
    {
        $user= auth()->user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
        $order = Order::where(['user_id'=> $user->id , 'order_status'=>0])->first();
        return view('customer.sales-process.payment',compact('cartItems','order'));
    }

    public function copanDiscount(Request $request)
    {

        $request->validate(['copan'=>'required']);

        $copan = Copan::where([ ['code',$request->copan] , ['status',1] , ['start_date','<',now()] ,['end_date','>',now()] ])->first();

        if($copan != null)
        {

            if($copan->user_id != null)
            {
                $copan = Copan::where([ ['code',$request->copan] , ['status',1] ,['start_date','<',now()],['end_date','>',now()] , ['user_id',auth()->user()->id]])->first();

                if($copan == null)
                {
                    return back()->with('swal-error','کد تخفیف وارد شده معتبر نی باشد');
                }
            }

            $order = Order::where(['user_id'=> auth()->user()->id , 'order_status'=>0 , 'copan_id'=>null])->first();

            if($order)
            {
                if($copan->amount_type == 0)
                {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);


                    if($copanDiscountAmount > $copan->discount_ceiling)
                    {
                        $copanDiscountAmount = $copan->discount_ceiling;
                    }


                }else
                {
                    $copanDiscountAmount = $copan->amount;
                }

                $order_final_amount = $order->order_final_amount - $copanDiscountAmount;
                $finalDiscount = $order->order_total_products_discount_amount + $copanDiscountAmount;

                $order->update(['copan_id'=>$copan->id , 'order_copan_discount_amount'=>$copanDiscountAmount , 'order_total_products_discount_amount'=>$finalDiscount , 'order_final_amount'=>$order_final_amount]);

                return back()->with('toast-success','کد تخفیف با موفقیت اعمال شد');

            }else{

                return back()->with('swal-error','کد تخفیف وارد شده قبلا استفاده شده است');

            }

        }else{

            return back()->with('swal-error','کد تخفیف وارد شده معتبر نمی باشد');
        }

    }

    public function paymentSubmit(Request $request)
    {
        $validate = $request->validate(['payment_type'=>'required']);

        switch ($request->payment_type) {

            case 1:
                dd('online');
                break;

            case 2:
                dd('offline');
                break;

            case 3:
                dd('cash');
                break;

            default:
                return back();
                break;
        }
    }
}
