@extends('customer.layouts.master-two-col')


@section('head-tag')
    <title>{{ $product->name }}</title>
@endsection


@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">

            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{ $product->name }} </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                @php
                                    $productGallery = $product->images()->get();
                                    //collecation of product image and products galleries
                                    $images = collect();
                                    $images->push($product->image);
                                    foreach ($productGallery as $gallery) {
                                        $images->push($gallery->image);
                                    }

                                @endphp


                                <section class="product-gallery">
                                    <section class="product-gallery-selected-image mb-3">

                                        <img src="{{ asset($images->first()['indexArray']['medium']) }}" alt="">

                                    </section>
                                    <section class="product-gallery-thumbs">

                                        @foreach ($images as $key => $image)
                                            <img class="product-gallery-thumb"
                                                src="{{ asset($image['indexArray']['medium']) }}"
                                                alt="{{ asset($image['indexArray']['medium']) . '-' . ($key + 1) }}"
                                                data-input="{{ asset($image['indexArray']['medium']) }}">
                                        @endforeach

                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{ $product->name }}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">

                                    @php
                                        $colors = $product->colors()->get();

                                    @endphp

                                    @if ($colors->count() !== 0)
                                        <p>
                                            <span>رنگ انتخاب شده :<span
                                                    id="selected_color_name">{{ $colors->first()->color_name }}</span></span>
                                        </p>
                                        <p>
                                            @foreach ($colors as $key => $color)
                                                <label for="{{ 'color_' . $color->id }}"
                                                    style="background-color: {{ $color->color ?? '#ffff' }};"
                                                    class="product-info-colors me-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="{{ $color->color_name }}">

                                                </label>

                                                <input type="radio" class="d-none" name="color"
                                                    value="{{ $color->id }}" id="{{ 'color_' . $color->id }}"
                                                    data-color-name='{{ $color->color_name }}'
                                                    data-product-color-price='{{ $color->price_increase }}'
                                                    @if ($key == 0) checked @endif>
                                            @endforeach

                                        </p>
                                    @endif

                                    @php
                                        $guarantees = $product->guarantees()->get();

                                    @endphp

                                    @if ($guarantees->count() !== 0)
                                        <p>
                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                            گارانتی :
                                            <select name="guarantee" id="guarantee">
                                                @foreach ($guarantees as $key => $guarantee)
                                                    <option value="{{ $guarantee->id }}"
                                                        data-product-guarantee-price='{{ $guarantee->price_increase }}'
                                                        @if ($key == 0) selected @endif>
                                                        {{ $guarantee->name }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    @endif


                                    <p>
                                        <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                        <span>{{ $product->marketable_number > 0 ? 'کالا موجود در انبار' : 'کالا ناموجود ' }}</span>
                                    </p>

                                    <p>
                                        <a class="btn btn-light  btn-sm text-decoration-none" href="#">
                                            <i class="fa fa-heart text-danger"></i> افزودن به علاقه مندی
                                        </a>
                                    </p>
                                    <section>
                                        <section class="cart-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input type="number" id="number" min="1" max="5"
                                                step="1" value="1" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                    </section>

                                    <p class="mb-3 mt-5">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای
                                        ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب
                                        کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                        پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب
                                        کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                    </p>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالا</p>
                                    <p class="text-muted"><span id="product-price"
                                            data-product-original-price='{{ $product->price }}'>{{ priceFormat($product->price) }}</span><span
                                            class="small">تومان</span></p>
                                </section>

                                @if (!empty($product->activeAmazingSales()))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالا</p>
                                        <p class="text-danger fw-bolder" id="product-discount-price"
                                            data-product-discount-price="{{ ($product->price * $product->activeAmazingSales()->percentage) / 100 }}">
                                            {{ priceFormat(($product->price * $product->activeAmazingSales()->percentage) / 100) }}
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>
                                @endif

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-end align-items-center">
                                    <p class="fw-bolder"><span id="final-price"></span> <span class="small">تومان</span>
                                    </p>
                                </section>


                                <section class="">
                                    @if ($product->marketable_number > 0)
                                        <a id="next-level" href="#" class="btn btn-danger d-block">افزودن به سبد
                                            خرید</a>
                                    @else
                                        <a id="next-level" href="#" class="btn btn-secondary disabled d-block">محصول
                                            ناموجود می باشد</a>
                                    @endif

                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->



    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($relatedProducts as $key => $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a href="#"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>
                                                <section class="product-add-to-favorite"><a href="#"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>
                                                </section>
                                                <a class="product-link"
                                                    href="{{ route('customer.market.product', $relatedProduct) }}">
                                                    <section class="product-image">
                                                        <img class=""
                                                            src="{{ asset($relatedProduct->image['indexArray']['medium']) }}"
                                                            alt="">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{ $relatedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-price">
                                                            {{ priceFormat($relatedProduct->price) }} تومان</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        <section class="product-colors-item"
                                                            style="background-color: yellow;"></section>
                                                        <section class="product-colors-item"
                                                            style="background-color: green;"></section>
                                                        <section class="product-colors-item"
                                                            style="background-color: white;"></section>
                                                        <section class="product-colors-item"
                                                            style="background-color: blue;"></section>
                                                        <section class="product-colors-item"
                                                            style="background-color: red;"></section>
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
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                href="#comments">دیدگاه ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                {!! $product->introduction !!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">


                                    @foreach ($product->values as $value)
                                        <tr>
                                            <td>{{ $value->attribute->name }}</td>
                                            <td>{{ json_decode($value->value)->value . ' ' . $value->attribute->unit }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($product->metas as $meta)
                                        <tr>
                                            <td>{{ $meta->meta_name }}</td>
                                            <td>{{ $meta->meta_value }}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">

                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه</button>
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1"
                                        aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i
                                                            class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </section>

                                                @guest
                                                    <section class="modal-body">
                                                        <p>کاربر گرامی برای ثبت نظر ابتدا وارد حساب کاربری خود شوید</p>
                                                        <p>
                                                            <a class="text-decoration-none"
                                                                href="{{ route('auth.customer.login-register-form') }}">لینک
                                                                ثبت نام و یا ورود</a>
                                                        </p>
                                                    </section>
                                                @endguest
                                                @auth
                                                    <section class="modal-body">
                                                        <form class="row"
                                                            action="{{ route('customer.market.add-comment', $product) }}"
                                                            method="post">
                                                            @csrf

                                                            {{-- <section class="col-6 mb-2">
                                                        <label for="first_name" class="form-label mb-1">نام</label>
                                                        <input type="text" class="form-control form-control-sm" id="first_name" placeholder="نام ...">
                                                    </section>

                                                    <section class="col-6 mb-2">
                                                        <label for="last_name" class="form-label mb-1">نام خانوادگی</label>
                                                        <input type="text" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی ...">
                                                    </section> --}}

                                                            <section class="col-12 mb-2">
                                                                <label for="comment" class="form-label mb-1">دیدگاه
                                                                    شما</label>
                                                                <textarea class="form-control form-control-sm" name="body" id="comment" placeholder="دیدگاه شما ..."
                                                                    rows="4"></textarea>
                                                                @error('body')
                                                                    <span class="alert_required bg-danger text-white p-1 rounded"
                                                                        role="alert">
                                                                        <strong>
                                                                            {{ $message }}
                                                                        </strong>
                                                                    </span>
                                                                @enderror
                                                            </section>

                                                            <section class="modal-footer py-1">
                                                                <button type="submit" class="btn btn-sm btn-primary">ثبت
                                                                    دیدگاه</button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">بستن</button>
                                                            </section>
                                                        </form>
                                                    </section>
                                                @endauth

                                            </section>
                                        </section>
                                    </section>
                                </section>



                                @forelse ($product->activeComments as $activeComment)
                                    <section class="product-comment">
                                        <section class="product-comment-header d-flex justify-content-start">
                                            <section class="product-comment-date">
                                                {{ jalaliDate($activeComment->created_at) }}</section>

                                            @php
                                                $user = $activeComment->user()->first();
                                            @endphp
                                            <section class="product-comment-title">
                                                @if (empty($user->first_name) && empty($user->last_name))
                                                    ناشناس
                                                @else
                                                    {{ $user->fullName }}
                                                @endif
                                            </section>
                                        </section>
                                        <section class="product-comment-body">
                                            {!! $activeComment->body !!}
                                        </section>

                                        @php
                                            $commentAnswers = $activeComment->answers()->get();
                                        @endphp

                                        @foreach ($commentAnswers as $commentAnswer)
                                            <section class="product-comment ms-5 border-bottom-0">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-date">
                                                        {{ jalaliDate($commentAnswer->created_at) }}</section>
                                                    @php
                                                        $user = $commentAnswer->user()->get();
                                                    @endphp
                                                    <section class="product-comment-title">
                                                        @if (empty($user->first_name) && empty($user->last_name))
                                                            ناشناس
                                                        @else
                                                            {{ $user->fullName }}
                                                        @endif
                                                    </section>
                                                </section>
                                                <section
                                                    class="product-comment-body @if ($commentAnswer->answers()->count() > 0) border-bottom @endif">
                                                    {!! $commentAnswer->body !!}
                                                </section>
                                            </section>
                                        @endforeach

                                    </section>
                                @empty
                                    <p class="my-2">دیدگاهی برای این محصول وجود ندارد</p>
                                @endforelse

                            </section>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            bill();

            $("input[name='color']").change(function() {

                bill();
            })

            $("#guarantee").change(function() {

                bill();
            })

            $('.cart-number').click(function() {
                bill();
            })

            function bill() {
                //price computing
                let product_original_price = parseFloat($('#product-price').attr('data-product-original-price'));
                let selected_color_price = 0;
                let selected_guarantee_price = 0;
                let product_discount_price = 0;
                let number = 1;

                if ($('input[name="color"]:checked').length !== 0) {
                    let selected_color = $('input[name="color"]:checked');
                    $('#selected_color_name').html(selected_color.attr('data-color-name'));

                    selected_color_price = parseFloat(selected_color.attr('data-product-color-price'));
                }

                if ($('#guarantee option:selected').length !== 0) {
                    selected_guarantee_price = parseFloat($('#guarantee option:selected').attr(
                        'data-product-guarantee-price'));
                }

                if ($('#product-discount-price').length !== 0) {
                    product_discount_price = parseFloat($('#product-discount-price').attr(
                        'data-product-discount-price'))
                }

                if ($('#number').val() > 0) {
                    number = parseFloat($('#number').val());
                }

                //final price

                let product_price = product_original_price + selected_color_price + selected_guarantee_price;
                let final_price = number * (product_price - product_discount_price);

                $('#final-price').html(toPersianNumber(final_price))

            }

            function toPersianNumber(number)
            {
                const persianDigits= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];

                //add comma
                number = new Intl.NumberFormat().format(number);

                //convert to persian
                return number.toString().replace(/\d/g, x => persianDigits[x]);
            }
        });
    </script>
@endsection
