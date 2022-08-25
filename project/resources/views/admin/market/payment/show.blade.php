@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش پرداخت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> پرداخت ها</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش پرداخت </h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-blue">
                        {{ $payment->user->fullName }}  - {{ $payment->user_id }}
                    </section>

                    <section class="card-body">
                        <h6>مبلغ پرداخت شده : {{ $payment->amount }}</h6>
                        <h6 class="py-2">بانک : {{ $payment->paymentable->gateway ?? '_' }}</h6>
                        <h6>کد تراکنش : {{ $payment->paymentable->transaction_id ?? '_' }}</h6>
                        <h6 class="py-2">تاریخ پرداخت : {{ jalaliDate($payment->pay_date) ?? '_' }}</h6>
                        <h6>دریافت کننده : {{  $payment->paymentable->cash_receiver ?? '_' }}</h6>
                    </section>
                </section>


            </section>
        </section>
    </div>
@endsection
