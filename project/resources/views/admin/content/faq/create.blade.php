@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد پرسش</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> سوالات متداول</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پرسش</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد پرسش</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">پرسش</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-12">
                                <label for="">پاسخ</label>
                                <textarea class="form-control form-control-sm" name="body" id="body" rows="4"></textarea>
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
        CKEDITOR.replace('body');
    </script>
@endsection
