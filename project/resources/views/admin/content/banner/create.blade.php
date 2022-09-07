@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد بنر</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بنر</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد بنر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد بنر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.banner.store') }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="title">عنوان بنر</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                        value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="url">آدرس</label>
                                    <input type="text" class="form-control form-control-sm" name="url"
                                        value="{{ old('url') }}">
                                </div>
                                @error('url')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="image">تصویر </label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                </div>
                                @error('image')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
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

                            <section class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="position">مکان</label>
                                    <input type="text" class="form-control form-control-sm" name="position"
                                        value="{{ old('position') }}">
                                </div>
                                @error('position')
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

@section('script')

    <script>
        $(document).ready(function() {

            let tags_input = $('#tags');
            let select_tags = $('#select_tags');
            let default_tags = tags_input.val();
            let default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            $(select_tags).select2({
                placeholder: 'لطفا برچسب ها را وارد کنید',
                tags: true,
                data: default_data
            })

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function() {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    let selected_source = select_tags.val().join(',');
                    tags_input.val(selected_source)
                }
            })
        })
    </script>
@endsection
