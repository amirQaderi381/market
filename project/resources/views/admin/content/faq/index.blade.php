@extends('admin.layouts.master')

@section('head-tag')
    <title>سوالات متداول</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>سوالات متداول</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.faq.create') }}" class="btn btn-info btn-sm">ایجاد پرسش جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">پرسش</th>
                                <th scope="col">خلاصه پاسخ</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>چجوری میتونیم ثبت نام کنیم</td>
                                <td>به بخش ثبت نام مراجعه...</td>
                                <td class="width-16-rem text-left">
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>چجوری میتونیم ثبت نام کنیم</td>
                                <td>به بخش ثبت نام مراجعه...</td>
                                <td class="width-16-rem text-left">
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>چجوری میتونیم ثبت نام کنیم</td>
                                <td>به بخش ثبت نام مراجعه...</td>
                                <td class="width-16-rem text-left">
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> حذف
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
