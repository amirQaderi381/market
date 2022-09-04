@extends('customer.layouts.master-simple')

@section('head-tag')
<title>تایید کد احراز هویت</title>
@endsection

@section('content')

<section class="vh-100 d-flex justify-content-center align-items-center pb-5">
     <form action="{{ route('auth.customer.login-confirm',$token) }}" method="post">
        @csrf
        <section class="login-wrapper mb-5">
            <section class="login-logo">
                <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
            </section>
            <section class="login-title">
                <a href="{{ route('auth.customer.login-register-form') }}">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </section>
            <section class="login-title">
               <p>کد تایید را وارد نمایید</p>
            </section>
            @if($otpCode->type == 0)
            <section class="login-info">
                <p> کد تایید برای شماره موبایل {{ $otpCode->login_id }}ارسال شد</p>
            </section>
            @elseif ($otpCode->type == 1)
            <section class="login-info">
                <p> کد تایید برای آدرس ایمیل {{ $otpCode->login_id }}ارسال شد</p>
            </section>
            @endif
            <section class="login-input-text">
               <input type="text" name="id" >  {{--  id => identifier --}}
               @error('id')
                    <span role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
               @enderror
            </section>
            <section class="login-btn d-grid g-2"><button class="btn btn-danger">تایید</button></section>
        </section>
     </form>
</section>

@endsection
