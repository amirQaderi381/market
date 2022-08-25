<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));
    }

    public function online()
    {
        $payments = Payment::where('paymentable_type','App\Models\Market\OnlinePayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));
    }

    public function offline()
    {
        $payments = Payment::where('paymentable_type','App\Models\Market\OfflinePayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));
    }

    public function cash()
    {
        $payments = Payment::where('paymentable_type','App\Models\Market\CashPayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $result=$payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success','تغییر شما با موفقیت ثیت شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $result=$payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success','تغییر شما با موفقیت ثیت شد');
    }


    public function show(Payment $payment)
    {
        return view('admin.market.payment.show',compact('payment'));
    }

}
