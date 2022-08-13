@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر مشتری</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کاربران مشتری</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر مشتری</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کاربر مشتری
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.update',$customer->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="first_name">نام</label>
                                    <input type="text" name="first_name" class="form-control form-control-sm"
                                        value="{{ old('first_name',$customer->first_name) }}">
                                </div>
                                @error('first_name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control form-control-sm"
                                        value="{{ old('last_name',$customer->last_name) }}">
                                </div>
                                @error('last_name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" name="profile_photo_path" class="form-control form-control-sm">
                                    <img src="{{ asset($customer->profile_photo_path) }}" alt="" class="w-50 mt-3">
                                </div>
                                @error('profile_photo_path')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <section class="form-group">
                                    <label for="status">وضعیت کاربر</label>
                                    <select class="form-control form-control-sm" name="status" id="status">
                                        <option value="0" @if (old('status',$customer->status) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('status',$customer->status) == 1) selected @endif>فعال
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

                            <section class="col-12 my-2">
                                <section class="form-group">
                                    <label for="activation">وضعیت فعال سازی</label>
                                    <select class="form-control form-control-sm" name="activation" id="activation">
                                        <option value="0" @if (old('activation',$customer->activation) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('activation',$customer->activation) == 1) selected @endif>فعال
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
                                <button class="btn btn-primary btn-sm px-5">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
