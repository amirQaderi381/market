@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد برند </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> برند </a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد برند جدید</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد برند </h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">نام برند</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> تصویر</label>
                                <input type="file" class="form-control form-control-sm " name="" id="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </div>
@endsection
