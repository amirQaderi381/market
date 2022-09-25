<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PaymentController extends Controller
{
    public function payment()
    {
        return view('customer.sales-process.payment');
    }

    public function copanDiscount(Request $request)
    {

        $request->validate(['copan'=>'required']);

        $copan = Copan::where([ ['code',$request->copan] , ['status',1] , ['start_date','<',now()] ,['end_date','>',now()] ])->first();

        if($copan)
        {

            if($copan->user_id != null)
            {
                $copan = Copan::where([ ['code',$request->copan] , ['status',1] ,['start_date','<',now()],['end_date','>',now()] , ['user_id',auth()->user()->id]])->first();

                if($copan == null)
                {
                    return back()->with('swal-error','کد تخفیف وارد شده معتبر نیست');
                }

            }

            $order = Order::where(['user_id',auth()->user()->id] , ['order_status',0] , ['copan_id',null])->first();

            if($order)
            {
                if($copan->amount_type == 0)
                {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);

                    if($copanDiscountAmount > $order->discount_ceiling)
                    {
                        $copanDiscountAmount = $order->discount_ceiling;
                    }

                }else
                {
                    $copanDiscountAmount = $copan->amount;
                }

                $order_final_amount = $order->order_final_amount - $copanDiscountAmount;
                $finalDiscount = $order->order_total_products_discount_amount + $copanDiscountAmount;

                $order->update(['copan_id'=>$copan->id , 'order_copan_discount_amount'=>$copanDiscountAmount , 'order_total_products_discount_amount'=>$finalDiscount , 'order_final_amount'=>$order_final_amount]);
            }

        }

    }
}
