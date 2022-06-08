@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نقش ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نقش ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام نقش</th>
                                <th scope="col">دسترسی ها</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>پشتیبان فروش </td>
                                <td>
                                    <ol class="px-2">
                                        <li>مشاهده سفارشات</li>
                                        <li>مشاهده پرداخت ها</li>
                                        <li>مشاهده تخفیف ها</li>
                                    </ol>
                                </td>
                                <td class="width-20-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-user-graduate"></i> دسترسی
                                        ها</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash-alt"></i> حذف
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>پشتیبان فروش </td>
                                <td>
                                    <ol class="px-2">
                                        <li>مشاهده سفارشات</li>
                                        <li>مشاهده پرداخت ها</li>
                                        <li>مشاهده تخفیف ها</li>
                                    </ol>
                                </td>
                                <td class="width-20-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-user-graduate"></i> دسترسی
                                        ها</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash-alt"></i> حذف
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>پشتیبان فروش </td>
                                <td>
                                    <ol class="px-2">
                                        <li>مشاهده سفارشات</li>
                                        <li>مشاهده پرداخت ها</li>
                                        <li>مشاهده تخفیف ها</li>
                                    </ol>
                                </td>
                                <td class="width-20-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-user-graduate"></i> دسترسی
                                        ها</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash-alt"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>
@endsection
