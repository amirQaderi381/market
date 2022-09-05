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
            @if($otp->type == 0)
            <section class="login-info">
                <p> کد تایید برای شماره موبایل {{ $otp->login_id }}ارسال شد</p>
            </section>
            @elseif ($otp->type == 1)
            <section class="login-info">
                <p> کد تایید برای آدرس ایمیل {{ $otp->login_id }}ارسال شد</p>
            </section>
            @endif
            <section class="login-input-text">
               <input type="text" name="otp" >
               @error('otp')
                    <span role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
               @enderror
            </section>
            <section class="login-btn d-grid g-2"><button class="btn btn-danger">تایید</button></section>

            <section id="resend-otp" class="d-none">
                <a href="" class="text-decoration-none">دریافت مجدد کد تایید</a>
            </section>
            <section id="timer"></section>
        </section>
     </form>
</section>

@endsection

@section('script')

@php
    $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(2)->timestamp - \Carbon\Carbon::now()->timestamp)*1000;
@endphp

<script>

    let resendOtp = $('#resend-otp');
    let timer = $('#timer');

     // Set the date we're counting down to
     let countDownDate = new Date().getTime()+{{ $timer }};

     let x = setInterval(() => {

        // Get today's date and time
        let now = new Date().getTime();

        // Find the distance between now and the count down date
        let distance = countDownDate - now;

        //Time calculations for minutes and seconds
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);


        if(minutes == 0)
        {
            timer.html('ارسال مجدد کد تایید تا ' + seconds + 'ثانیه دیگر ');

        }else{

            timer.html('ارسال مجدد کد تایید تا ' + minutes + 'دقیقه و ' + seconds + 'ثانیه دیگر ');
        }

        // If the count down is finished, write some text
        if(distance < 0)
        {
            clearInterval(x);
            timer.addClass('d-none');
            resendOtp.removeClass('d-none');
        }

     }, 1000);
</script>
@endsection
