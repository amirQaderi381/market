@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> کالا</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالا </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد کالا</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">نام کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">دسته کالا</label>
                                <select id="" class="form-control form-control-sm">
                                    <option selected>دسته را انتخاب کنید...</option>
                                    <option>وسایل الکترونیکی</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">فرم کالا</label>
                                <select id="" class="form-control form-control-sm">
                                    <option selected>دسته را انتخاب کنید...</option>
                                    <option>وسایل الکترونیکی</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> تصویر</label>
                                <input type="file" class="form-control form-control-sm " name="" id="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">وزن</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">قیمت کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-12">
                                <label for="">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" rows="6"></textarea>
                            </div>
                            <div class="form-group col-12 border-top border-bottom py-3 mb-3">
                                <div class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm" placeholder="ویژگی">
                                        </div>
                                    </section>
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm" placeholder="مقدار">
                                        </div>
                                    </section>
                                </div>
                                <button type="button" class="btn btn-success btn-sm">افزودن</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body')
    </script>
@endsection
