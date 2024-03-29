@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>سفارشات </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="" class="btn btn-info btn-sm disabled"> ایجاد سفارش
                        جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">کد سفارش</th>
                                <th scope="col">مجموع مبلغ سفارش(بدون تخفیف)</th>
                                <th scope="col">مجموع مبلغ تمامی تخفیفات</th>
                                <th scope="col">مبلغ تخفیف همه محصولات</th>
                                <th scope="col">مبلغ نهایی</th>
                                <th scope="col">وضعیت پرداخت</th>
                                <th scope="col">شیوه پرداخت</th>
                                <th scope="col">بانک</th>
                                <th scope="col">وضعیت ارسال</th>
                                <th scope="col">شیوه ارسال</th>
                                <th scope="col">وضعیت سفارش</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_final_amount }} تومان</td>
                                <td>{{ $order->order_discount_amount }} تومان</td>
                                <td>{{ $order->order_total_products_discount_amount }} تومان</td>
                                <td>{{ $order->order_final_amount - $order->order_discount_amount }} تومان</td>
                                <td>{{ $order->payment_status_value }}</td>
                                <td>{{ $order->payment_type_value }}</td>
                                <td>{{ $order->payment->paymentable->gateway ?? '_' }}</td>
                                <td>{{ $order->delivery_status_value }}</td>
                                <td>{{ $order->delivery->name }}</td>
                                <td>{{ $order->order_status_value }}</td>
                                <td class="text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-tools"></i> عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-right"
                                                href="{{ route('admin.market.order.show',$order->id) }}">
                                                <i class="fas fa-images"></i> مشاهده فاکتور
                                            </a>
                                            <a class="dropdown-item text-right"
                                                href="{{ route('admin.market.order.changeSendStatus',$order->id) }}">
                                                <i class="fas fa-list-ul"></i> تفییر وضعیت ارسال
                                            </a>
                                            <a class="dropdown-item text-right"
                                                href="{{ route('admin.market.order.changeOrderStatus',$order->id) }}">
                                                <i class="fas fa-edit"></i> تغییر وضعیت سفارش
                                            </a>
                                            <a class="dropdown-item text-right"
                                                href="{{ route('admin.market.order.cancelOrder',$order->id) }}">
                                                <i class="fas fa-window-close"></i> باطل کردن سفارش
                                            </a>
                                        </div>
                                    </div>
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
