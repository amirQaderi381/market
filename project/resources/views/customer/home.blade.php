@extends('customer.layouts.master-one-col')


@section('content')

    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">
            <section class="col-md-8 pe-md-1 ">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($slideShows as $slideShow)
                        <section class="item">
                            <a class="w-100 d-block h-auto text-decoration-none" href="{{ urldecode($slideShow->url) }}">
                              <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slideShow->image) }}" alt="{{ $slideShow->title }}">
                            </a>
                        </section>
                    @endforeach

                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $topBanner)
                   <section class="mb-2">
                        <a href="#" class="d-block">
                            <img class="w-100 rounded-2" src="{{ asset($topBanner->image) }}" alt="{{ $topBanner->title }}">
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->



    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                              @foreach($mostVisitedProducts as $mostVisitedProduct)

                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            {{-- <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section> --}}
                                            @guest

                                            <section class="product-add-to-favorite">
                                                <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endguest

                                            @auth

                                               @if($mostVisitedProduct->users->contains(Auth::user()->id))

                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                            <i class="fa fa-heart text-danger"></i>
                                                        </button>
                                                    </section>

                                                @else

                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </section>

                                                @endif

                                            @endauth
                                            <a class="product-link" href="{{ route('customer.market.product',$mostVisitedProduct) }}">
                                                <section class="product-image">
                                                    <img class="" src="{{ $mostVisitedProduct->image['indexArray'][$mostVisitedProduct->image['currentImage']] }}" alt="">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>{{Str::limit($mostVisitedProduct->name, 27, '...') }}</h3></section>
                                                <section class="product-price-wrapper">
                                                    {{-- <section class="product-discount">
                                                        <span class="product-old-price">6,895,000 </span>
                                                        <span class="product-discount-amount">10%</span>
                                                    </section> --}}
                                                    <section class="product-price">{{ priceFormat($mostVisitedProduct->price) }} تومان</section>
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($mostVisitedProduct->colors as $color)
                                                    <section class="product-colors-item" style="background-color: {{ $color->color }}"></section>
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
    <!-- end product lazy load -->



    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach ($middleBanners as $middleBanner)


                <section class="col-12 col-md-6 mt-2 mt-md-0">
                   <a href="">
                      <img class="d-block rounded-2 w-100" src="{{ asset($middleBanner->image) }}" alt="">
                   </a>
                </section>

                @endforeach

            </section>

        </section>
    </section>
    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($offerProducts as $offerProduct)

                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                            <section class="product-add-to-favorite">
                                                <a class="add-to-favorite" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </section>
                                            <a class="product-link" href="{{ route('customer.market.product',$offerProduct) }}">
                                                <section class="product-image">
                                                    <img class="" src="{{ $offerProduct->image['indexArray']['medium'] }}" alt="{{ $offerProduct->name }}">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>{{ Str::limit($offerProduct->name,27,'...') }}</h3></section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-discount">
                                                        {{-- <span class="product-old-price">342,000 </span>
                                                        <span class="product-discount-amount">22%</span> --}}
                                                    </section>
                                                    <section class="product-price">{{ priceFormat($offerProduct->price) }} تومان</section>
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($offerProduct->colors as $color)
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
    <!-- end product lazy load -->


    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col">
                    <img class="d-block rounded-2 w-100" src="{{ $bottomBanner->image }}" alt="{{ $bottomBanner->title }}">
                </section>
            </section>

        </section>
    </section>
    <!-- end ads section -->



    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4" >
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($brands as $brand)
                            <section class="item">
                                <section class="brand-item">
                                    <a href="#">
                                        <img class="rounded-2" src="{{ $brand->logo['indexArray']['medium'] }}" alt="{{ $brand->original_name }}">
                                    </a>
                                </section>
                            </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->

    <section class="toast-wrapper position-fixed p-4 flex-row-reverse" style="z-index: 909999999;left: 0; top: 3rem; width: 26rem; max-width: 80%;">
   </section>

@endsection

@section('script')
<script>
    $(document).ready(function(){

        $('.product-add-to-favorite button').click(function(){

            let url = $(this).attr('data-url');
            let element = $(this);

            $.ajax({

                type: 'GET',
                url:url,
                success:function(result)
                {

                    if(result.status == 1)
                    {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                        Toast('کالا با موفقیت به لیست علاقه مندی ها اضافه شد')

                    }else if(result.status == 2)
                    {
                        $(element).children().first().removeClass('text-danger');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی ها');
                        Toast('کالا با موفقیت از لیست علاه مندی ها حذف شد','danger')

                    }else if(result.status == 3)
                    {
                        Toast('برای افزودن کالا به لیست علاقه مندی ها ابتدا وارد حساب کاربری خود شوید','info');
                    }
                }
            })
        })

        function Toast(message,color='success') {
                let ToastTag = '<section class="toast" data-delay="2600">\n' +
                    '<section class="toast-body py-3 d-flex bg-'+color+' text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(ToastTag);
                $('.toast').toast('show').delay(2600).queue(function() {
                    $(this).remove();
                })
        };
    })
</script>
@endsection
