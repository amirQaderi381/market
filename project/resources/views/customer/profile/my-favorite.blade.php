@extends('customer.layouts.master-two-col')

@section('head-tag')
@endsection

@section('content')

<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
            @include('customer.layouts.partials.profile-sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header mb-4">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>لیست علاقه های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                   @forelse (auth()->user()->products as $product)

                    <section class="cart-item d-flex py-3">
                        <section class="cart-img align-self-start flex-shrink-1">
                            <img src="{{ asset($product->image['indexArray']['medium']) }}" alt="">
                        </section>
                        <section class="align-self-start w-100">
                            <p class="fw-bold">{{ $product->name }} </p>
                            <p>

                                @foreach($product->colors as $color)
                                <span style="background-color: {{ $color->color }};" class="cart-product-selected-color me-1"></span>
                                 <span>{{ $color->color_name }}</span>
                                 @endforeach
                            </p>

                            <p>
                               @if($product->guarantees->count()>0)
                               <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                               @foreach($product->guarantees as $guarantee)
                               <span>{{ $guarantee->name }}</span>
                               @endforeach
                               @endif
                            </p>

                            @if($product->marketable_number > 1)
                            <p>
                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                 <span>کالا موجود در انبار</span>
                            </p>
                            @else
                            <p>
                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                <span>کالا در انبار موجود نیست</span>
                            </p>
                            @endif

                            <section>
                                <a class="text-decoration-none cart-delete" href="{{ route('customer.profile.delete',$product->id) }}"><i class="fa fa-trash-alt"></i> حذف از لیست علاقه ها</a>
                            </section>
                        </section>
                        <section class="align-self-end flex-shrink-1">
                            @if($product->activeAmazingSales())
                            <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{priceFormat($product->price * ($product->activeAmazingSales()->percentage / 100)) }}</section>
                            @endif
                            <section class="text-nowrap fw-bold">{{ priceFormat($product->price) }} تومان</section>
                        </section>
                    </section>

                   @empty

                   <p>محصول یافت نشد</p>

                   @endforelse



                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->

@endsection
