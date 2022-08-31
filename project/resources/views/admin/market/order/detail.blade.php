@extends('admin.layouts.master')

@section('head-tag')
    <title>جزئیات سفارش</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5 class="mb-4">جزئیات سفارش </h5>
                </section>


                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام محصول</th>
                                <th scope="col">درصد فروش شگفت انگیز </th>
                                <th scope="col">مبلغ فروش شگفت انگیز</th>
                                <th scope="col">تعداد</th>
                                <th scope="col">جمع قیمت محصول</th>
                                <th scope="col">مبلغ نهایی</th>
                                <th scope="col">رنگ</th>
                                <th scope="col">گارانتی</th>
                                <th scope="col">ویژگی</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->singleProduct->name ?? '_' }}</td>
                                <td>{{ $item->amazingSale->percentage ?? '_' }}</td>
                                <td>{{ $item->amazing_sale_discount_amount ?? '_' }} تومان</td>
                                <td>{{ $item->number ?? '_' }}</td>
                                <td>{{ $item->final_product_price ?? '_' }} تومان</td>
                                <td>{{ $item->final_total_price ?? '_' }} تومان</td>
                                <td>{{ $item->color->color_name ?? '_' }}</td>
                                <td>{{ $item->guarantee->name ?? '_' }}</td>
                                <td>
                                    @forelse ($item->orderItemAttributes as $attribute)
                                    {{ $attribute->categoryAttribute->name ?? '_' }}
                                     :
                                   {{ json_decode($attribute->categoryAttributeValue->value)->value. " , " ?? '_'}}
                                   @empty
                                    _
                                   @endforelse
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </div>
@endsection
