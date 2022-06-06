@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> نظرات </a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرها </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش نظر ها</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-yellow">
                        کامران محمدی - 123456
                    </section>

                    <section class="card-body">
                        <h5>مشخصات کالا :‌ساعت هوشمند apple watch کد کالا : 123456</h5>
                        <p>به نظر من ساعت خوبیه</p>
                    </section>
                </section>

                <section>
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">پاسخ ادمین </label>
                                <textarea class="form-control form-control-sm" rows="4"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                    </form>
                </section>

            </section>
        </section>
    </div>
@endsection
