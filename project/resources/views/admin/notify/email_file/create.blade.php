@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه ایمیلی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فایل اطلاعیه ایمیلی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد فایل اطلاعیه ایمیلی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email-file.index',$email->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.notify.email-file.store',$email->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="file">فایل</label>
                                    <input type="file" class="form-control form-control-sm" name="file" id="file">
                                </div>
                                @error('file')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </section>


                            <section class="col-12 my-2">
                                <section class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select class="form-control form-control-sm" name="status" id="status">
                                        <option value="0" @if (old('status') == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('status') == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </section>
                                @error('status')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
