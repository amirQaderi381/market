@extends('customer.layouts.master-two-col')

@section('head-tag')
<title>پرداخت</title>
@endsection

@section('content')

 <!-- start cart -->
 <section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>انتخاب نوع پرداخت </span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <section class="col-md-9">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        کد تخفیف
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>

                            <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                <secrion>
                                    کد تخفیف خود را در این بخش وارد کنید.
                                </secrion>
                            </section>

                            <section class="row">
                                <section class="col-md-5">
                                    <form action="{{ route('customer.sales-process.copan-discount') }}" method="post">
                                        @csrf
                                        <section class="input-group input-group-sm">
                                            <input type="text" name="copan" class="form-control" placeholder="کد تخفیف را وارد کنید">
                                            <button class="btn btn-primary" type="submit">اعمال کد</button>
                                        </section>
                                        @error('copan')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </form>
                                </section>

                            </section>
                        </section>


                        <!-- start edit address Modal -->
                        <section class="modal fade" id="cash_payment_modal" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="add-address-label"></i>اطلاعات دریافت کننده</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </section>
                                    <section class="modal-body">
                                        <section class="input-group input-group-sm">
                                            <input  type="text" name="cash_receiver" form="paymentForm" class="form-control" placeholder="نام و نام خانوادگی" >
                                        </section>
                                    </section>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="document.getElementById('paymentForm').submit()">ثبت</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                    </div>


                                </section>
                            </section>
                        </section>
                        <!-- end edit address Modal -->



                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        انتخاب نوع پرداخت
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="payment-select">

                                <form action="{{ route('customer.sales-process.payment-submit') }}" method="post" id="paymentForm">
                                    @csrf
                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو پرداخت کنید.
                                        </secrion>
                                    </section>

                                    <input type="radio" name="payment_type" value="1" id="d1"/>
                                    <label for="d1" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-credit-card mx-1"></i>
                                            پرداخت آنلاین
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            درگاه پرداخت زرین پال
                                        </section>
                                    </label>

                                    <section class="mb-2"></section>

                                    <input type="radio" name="payment_type" value="2" id="d2"/>
                                    <label for="d2" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-id-card-alt mx-1"></i>
                                            پرداخت آفلاین
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            حداکثر در 2 روز کاری بررسی می شود
                                        </section>
                                    </label>

                                    <section class="mb-2"></section>

                                    <input type="radio" name="payment_type" value="3"  id="d3"/>
                                    <label for="d3" class="col-12 col-md-4 payment-wrapper mb-2 pt-2" id="cash_payment" data-bs-toggle="modal" data-bs-target="#cash_payment_modal">
                                        <section class="mb-2">
                                            <i class="fa fa-money-check mx-1"></i>
                                            پرداخت در محل
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            پرداخت به پیک هنگام دریافت کالا
                                        </section>
                                    </label>
                                </form>


                            </section>
                        </section>

                    </section>


                    <section class="col-md-3">
                        @php
                            $totalPrice=0;
                            $totalDiscount=0;
                        @endphp

                        @foreach ($cartItems as $cartItem)
                             @php
                                 $totalPrice+=$cartItem->cartItemProductPrice() * $cartItem->number;
                                 $totalDiscount+=$cartItem->cartItemProductDiscount() * $cartItem->number;
                             @endphp
                        @endforeach

                        <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                <p class="text-muted">{{ priceFormat($totalPrice) }} تومان</p>
                            </section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالاها</p>
                                <p class="text-danger fw-bolder">{{ priceFormat($totalDiscount) }} تومان</p>
                            </section>

                            <section class="border-bottom mb-3"></section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">جمع سبد خرید</p>
                                <p class="fw-bolder">{{ priceFormat($totalPrice - $totalDiscount) }} تومان</p>
                            </section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">هزینه ارسال</p>
                                <p class="text-warning">54,000 تومان</p>
                            </section>

                            @if (isset($order->commonDiscount))

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان تخفیف عمومی</p>
                                    <p class="text-danger">{{ priceFormat($order->commonDiscount->percentage) }} درصد</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان حداکثر تخفیف عمومی</p>
                                    <p class="text-danger">{{ priceFormat($order->commonDiscount->discount_ceiling) }} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">حداقل موجودی سبد خرید</p>
                                    <p class="text-danger">{{ priceFormat($order->commonDiscount->minimal_order_amount) }} تومان</p>
                                </section>

                            @endif

                            @if(isset($order->copan)  && $order->copan->end_date > now())

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان تخفیف کد تخفیف</p>
                                    @if($order->copan->amount_type == 0)
                                    <p class="text-danger">{{ priceFormat($order->copan->amount) }} درصد</p>
                                    @else
                                    <p class="text-danger">{{ priceFormat($order->copan->amount) }} تومان</p>
                                    @endif
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان حداکثر تخفیف کد تخفیف</p>
                                    <p class="text-danger">{{ priceFormat($order->copan->discount_ceiling) }} تومان</p>
                                </section>

                            @endif


                            <p class="my-3">
                                <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                            </p>

                            <section class="border-bottom mb-3"></section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">مبلغ قابل پرداخت</p>
                                <p class="fw-bold">{{priceFormat( $order->order_final_amount ?? 0) }} تومان</p>
                            </section>

                            <section class="">
                                <section id="payment-button" class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">نوع پرداخت را انتخاب کن</section>
                                <button type="submit" id="final-level" href="my-orders.html" class="btn btn-danger d-none" onclick="document.getElementById('paymentForm').submit()">ثبت سفارش و گرفتن کد رهگیری</button>
                            </section>

                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->

@endsection

@section('script')
{{-- <script>
    $(function(){
        $('#cash_payment').click(function(event){

            var newDiv = document.createElement('div');
            newDiv.innerHTML = `
            <section class="input-group input-group-sm">
                <input type="text" name="cash_receiver" class="form-control" form="payment_submit" placeholder="نام و نام خانوادگی دریافت کننده" >
            </section>
            `;
            document.getElementsByClassName('content-wrapper')[1].appendChild(newDiv);

        })
    })
</script> --}}
@endsection
