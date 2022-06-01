@extends('admin.layouts.master')

@section('head-tag')
    <title> نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نظرات </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نویسنده نظر</th>
                                <th scope="col">کد کابر </th>
                                <th scope="col">کد کالا</th>
                                <th scope="col">کالا</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>سهیل کاشانی</td>
                                <td>123456</td>
                                <td>123456</td>
                                <td>ساعت هوشمند</td>
                                <td>تایید شده</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.comment.show') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> نمایش
                                    </a>

                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-clock"></i> عدم تایید
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>سهیل کاشانی</td>
                                <td>123456</td>
                                <td>123456</td>
                                <td>ساعت هوشمند</td>
                                <td>در انتظار تایید </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.comment.show') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> نمایش
                                    </a>


                                    <button type="submit" class="btn btn-success btn-sm px-3">
                                        <i class="fas fa-check"></i> تایید
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>سهیل کاشانی</td>
                                <td>123456</td>
                                <td>123456</td>
                                <td>ساعت هوشمند</td>
                                <td>تایید شده</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.comment.show') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> نمایش
                                    </a>

                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-clock"></i> عدم تایید
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </div>
@endsection
