<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\OnlinePayment;
use App\Models\Market\OfflinePayment;

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

    public function paymentSubmit(Request $request , PaymentService $paymentService)
    {
        $validate = $request->validate(['payment_type'=>'required']);

        $user = auth()->user();
        $cartItems = CartItem::where('user_id',$user->id)->get();
        $order = Order::where('user_id',$user->id)->where('order_Status',0)->first();
        $cash_receiver = null;


        switch ($request->payment_type) {

            case 1:

               $targetModel = OnlinePayment::class;
               $type = 0;
               break;

            case 2:

               $targetModel = OfflinePayment::class;
               $type = 1;
               break;

            case 3:

                $targetModel = CashPayment::class;
                $type = 2;
                $cash_receiver = $request->cash_receiver;
                break;

            default:
                return back();
                break;
        }

        $paymented=$targetModel::create([

            'amount'=>$order->order_final_amount,
            'user_id'=>auth()->user()->id,
            'pay_date'=>now(),
            'status'=>1,
            'cash_receiver'=>$cash_receiver
        ]);

        $payment=Payment::create([

            'amount'=>$order->order_final_amount,
            'user_id'=>auth()->user()->id,
            'pay_date'=>now(),
            'status'=>1,
            'type' => $type,
            'paymentable_id' => $paymented->id,
            'paymentable_type'=>$targetModel
        ]);

        if($request->payment_type == 1)
        {
            $paymentService->zarinpal($order->order_final_amount,$order,$paymented);

        }

        $order->update([

            'payment_id'=>$payment->id,
            'payment_type'=>$type,
            'payment_status'=>1,
            'order_status'=>3
        ]);


        foreach($cartItems as $cartItem)
        {
            $cartItem->delete();
        }

        return redirect()->route('customer.home')->with('toast-success','سفارش شما با موفقیت ثبت شد');


    }

    public function paymentCallback(Order $order , OnlinePayment $onlinePayment , PaymentService $paymentService)
    {
        $amount = $onlinePayment->amount * 10;
        $result = $paymentService->zarinpalVerify($amount,$onlinePayment);
        if($result['success'])
        {
            return 'ok';
        }else
        {
            return redirect()->route('customer.home')->with('toast-error','سفارش شما با خطا مواجه شد');
        }
    }
}
