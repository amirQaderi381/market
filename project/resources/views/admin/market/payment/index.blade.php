@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پرداخت ها</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد پرداخت جدید </a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">کد تراکنش </th>
                                <th scope="col">بانک </th>
                                <th scope="col">پرداخت کننده </th>
                                <th scope="col">وضعیت پرداخت </th>
                                <th scope="col">نوع پرداخت </th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>123456</td>
                                <td>ملت</td>
                                <td>امیر قادری</td>
                                <td>تایید شده</td>
                                <td>انلاین</td>
                                <td class="width-22-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> مشاهده
                                    </a>

                                    <a href="#" class="btn btn-warning btn-sm">
                                        باطل کردن
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-reply"></i> برگرداندن
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </div>
@endsection
