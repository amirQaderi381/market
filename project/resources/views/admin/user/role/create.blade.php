@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش جدید</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد نقش جدید
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="pb-3">
                    <form action="" method="">
                        <section class="form-row align-items-center">

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="">عنوان نقش</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                            </section>

                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="">توضیح نقش</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                            </section>

                            <section class="col-12 col-md-2 mt-md-2">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

                <section class="col-12">
                    <section class="row border-top py-2">
                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check1" checked>
                                <label class="form-check-label mr-3 mt-1" for="check1">
                                    نمایش دسته جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check2" checked>
                                <label class="form-check-label mr-3 mt-1" for="check2">
                                    نمایش کالا جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check3" checked>
                                <label class="form-check-label mr-3 mt-1" for="check3">
                                    ایجاد دسته جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check4" checked>
                                <label class="form-check-label mr-3" for="check4">
                                    ایجاد کالا جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check5" checked>
                                <label class="form-check-label mr-3" for="check5">
                                    ویرایش دسته جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check6" checked>
                                <label class="form-check-label mr-3" for="check6">
                                    ویرایش کالا جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check7" checked>
                                <label class="form-check-label mr-3" for="check7">
                                    حذف دسته جدید
                                </label>
                            </div>
                        </section>

                        <section class="col-12 col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check8" checked>
                                <label class="form-check-label mr-3" for="check8">
                                    حذف کالا جدید
                                </label>
                            </div>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
@endsection
