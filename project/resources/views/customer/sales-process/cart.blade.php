@extends('customer.layouts.master-two-col')

@section('head-tag')
<title>سبد خرید شما </title>
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
                            <span>سبد خرید شما</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <section class="col-md-9 mb-3">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <form action="{{ route('customer.salesProcess.update-cart') }}" id="cart_items" method="post">
                                @csrf

                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp

                                @foreach($cartItems as $cartItem)
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPrice();
                                    $totalDiscount += $cartItem->cartItemProductDiscount();
                                @endphp
                                <section class="cart-item d-md-flex py-3">
                                    <section class="cart-img align-self-start flex-shrink-1">
                                        <img src="{{ asset($cartItem->product->image['indexArray']['medium']) }}" alt="">
                                    </section>
                                    <section class="align-self-start w-100">
                                        <p class="fw-bold">{{ $cartItem->product->name }}</p>
                                        <p>
                                            @if(!empty($cartItem->color))
                                            <span style="background-color: {{ $cartItem->color->color }};" class="cart-product-selected-color me-1"></span>
                                            <span>{{ $cartItem->color->color_name }}</span>
                                            @else
                                            برای این محصول رنگ انتخابی وجود ندارد
                                            @endif
                                        </p>
                                        <p>
                                            @if(!empty($cartItem->guarantee))
                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                            <span>{{ $cartItem->guarantee->name }}</span>
                                            @else
                                            برای این محصول گارانتی وجود ندارد
                                            @endif
                                        </p>
                                        <p>
                                            <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            <span>کالا موجود در انبار</span>
                                        </p>

                                        <section>
                                            <section class="cart-product-number d-inline-block ">
                                                <button class="cart-number cart-number-down" type="button">-</button>
                                                <input class="number" type="number" name="number[{{ $cartItem->id }}]" min="1" max="5" step="1" value="{{ $cartItem->number }}" data-product-price="{{ $cartItem->cartItemProductPrice() }}" data-product-discount="{{ $cartItem->cartItemProductDiscount() }}" readonly="readonly">
                                                <button class="cart-number cart-number-up" type="button">+</button>
                                            </section>
                                            <a class="text-decoration-none ms-4 cart-delete" href="{{ route('customer.salesProcess.remove-from-cart',$cartItem) }}">
                                                <i class="fa fa-trash-alt"></i> حذف از سبد
                                            </a>
                                        </section>

                                    </section>
                                    <section class="align-self-end flex-shrink-1">
                                        @if(!empty($cartItem->product->activeAmazingSales()))
                                        <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{ priceFormat($cartItem->cartItemProductDiscount()) }}</section>
                                        @endif
                                        <section class="text-nowrap fw-bold">{{ priceFormat($cartItem->cartItemProductPrice()) }} تومان</section>
                                    </section>
                                </section>
                                @endforeach
                            </form>

                        </section>
                    </section>
                    <section class="col-md-3">
                        <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted" >قیمت کالاها ({{ $cartItem->count() }})</p>
                                <p class="text-muted" id="total_product_price">{{ priceFormat($totalProductPrice) }} تومان</p>
                            </section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالاها</p>
                                <p class="text-danger fw-bolder" id="total_discount">{{ priceFormat($totalDiscount) }} تومان</p>
                            </section>
                            <section class="border-bottom mb-3"></section>
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">جمع سبد خرید</p>
                                <p class="fw-bolder" id="total_price">{{ priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
                            </section>

                            <p class="my-3">
                                <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                            </p>


                            <section class="">
                                <button class="btn btn-danger d-block w-100" onclick="document.getElementById('cart_items').submit()">تکمیل فرآیند خرید</button>
                            </section>

                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->

<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>کالاهای مرتبط با سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper" >
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">

                            @foreach($relatedProducts as $relatedProduct)

                            <section class="item">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        <section class="product-add-to-cart">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                                <i class="fa fa-cart-plus"></i>
                                            </a>
                                        </section>
                                        @guest
                                        <section class="product-add-to-favorite">
                                            <a data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" data-url="{{ route('customer.market.add-to-favorite',$relatedProduct) }}">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>
                                        @endguest

                                        @auth
                                           @if($relatedProduct->users->contains(Auth::user()->id))
                                                <section class="product-add-to-favorite">
                                                  <a data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" data-url="{{ route('customer.market.add-to-favorite',$relatedProduct) }}">
                                                     <i class="fa fa-heart text-danger"></i>
                                                  </a>
                                                </section>
                                            @else

                                                <section class="product-add-to-favorite">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" data-url="{{ route('customer.market.add-to-favorite',$relatedProduct) }}">
                                                      <i class="fa fa-heart"></i>
                                                    </a>
                                                </section>
                                            @endif
                                        @endauth
                                        <a class="product-link" href="{{ route('customer.market.product',$relatedProduct) }}">
                                            <section class="product-image">
                                                <img class="" src="{{ asset($relatedProduct->image['indexArray']['medium']) }}" alt="">
                                            </section>
                                            <section class="product-name">
                                                <h3>{{ $relatedProduct->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                <section class="product-price">{{ priceFormat($relatedProduct->price) }} تومان</section>
                                            </section>
                                            <section class="product-colors">
                                                @foreach($relatedProduct->colors as $color)
                                                  <section class="product-colors-item" style="background-color: {{ $color->color }};"></section>
                                                @endforeach
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            </section>

                            @endforeach

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>



@endsection

@section('script')

<script>
    $(document).ready(function(){

        bill();

        $('.cart-number').click(function(){

            bill();
        });

        function bill()
        {
           let total_product_price = 0;
           let total_discount = 0;
           let total_price = 0;

           $('.number').each(function(){

              let product_price = parseFloat($(this).data('product-price'));
              let product_discount = parseFloat($(this).data('product-discount'));
              let number = parseFloat($(this).val());

              total_product_price += product_price * number;
              total_discount += product_discount * number;

           });

            total_price = total_product_price - total_discount;

            $('#total_product_price').html(toFarsiNumber(total_product_price));
            $('#total_discount').html(toFarsiNumber(total_discount));
            $('#total_price').html(toFarsiNumber(total_price));

            function toFarsiNumber(number)
            {
                const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                // add comma
                number = new Intl.NumberFormat().format(number);
                //convert to persian
                return number.toString().replace(/\d/g, x => farsiDigits[x]);
            }
        }

    })
</script>

<script>
    $('.product-add-to-favorite a').click(function(){

        let url = $(this).attr('data-url');
        let element = $(this);

        $.ajax({

            url:url,
            success:function(result)
            {
                if(result.status == 1)
                {
                  element.children().first().addClass('text-danger');
                  element.attr('data-bs-original-title','حذف از علاقه مندی');
                  Toast('کالا با موفقیت به لیست علاقه مندی ها اضافه شد')
                }

                else if(result.status == 2)
                {
                    element.children().first().removeClass('text-danger');
                    element.attr('data-bs-original-title','افزودن به علاقه مندی');
                    Toast('کالا با موفقیت از لیست علاه مندی ها حذف شد')
                }

                else if(result.status == 3)
                {
                    Toast('برای افزودن کالا به لیست علاقه مندی ها ابتدا باید وارد حساب کاربری خود شوید');
                }
            }
        });


        function Toast(message) {
                let ToastTag = '<div class="toast"  data-delay="7000" role="alert" aria-live="assertive" aria-atomic="true">\n' +
                    '<div class="toast-header">' +
                    '<strong class="me-auto">فروشگاه</strong>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>' +
                    '</div>'+
                    '<div class="toast-body">'+
                    '<strong class="ml-auto">'+
                    message
                    ' </strong>'+
                    ' </strong>'+
                    ' </section>'+

                $('.toast-wrapper').append(ToastTag);
                $('.toast').toast('show').delay(7000).queue(function() {
                    $(this).remove();
                })
        };

    })
</script>
@endsection
