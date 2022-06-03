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
                    <a href="{{ route('admin.market.order.new.orders') }}" class="btn btn-info btn-sm"> ایجاد سفارش
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
                                <th scope="col">مبلغ سفارش</th>
                                <th scope="col">مبلغ تخفیف</th>
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
                            <tr>
                                <th>1</th>
                                <td>123456</td>
                                <td>26000 تومان</td>
                                <td>20000 تومان</td>
                                <td>26000 تومان</td>
                                <td><i class="fas fa-credit-card"></i> پرداخت شده</td>
                                <td>آنلاین</td>
                                <td>ملت</td>
                                <td><i class="fas fa-clock"></i> درحال ارسال</td>
                                <td>پیک موتوری</td>
                                <td>درحال ارسال</td>
                                <td class="text-left">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-cogs"></i> عملیات
                                    </button>
                                </td>
                                <section class="order-operation rounded">
                                    <section class="list-group rounded">
                                        <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                            <i class="fas fa-cog"></i> تنظیمات
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                            <i class="fas fa-user"></i> کاربر
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                            <i class="far fa-envelope"></i> پیام ها
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                            <i class="fas fa-lock"></i> قفل صفحه
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                            <i class="fas fa-sign-out-alt"></i> خروج
                                        </a>
                                    </section>
                                </section>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </div>
@endsection
