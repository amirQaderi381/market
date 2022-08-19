@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش برند </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> برند </a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش برند جدید</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش برند </h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.brand.update', $brand->id) }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="original_name">نام اصلی برند</label>
                                    <input type="text" name="original_name" class="form-control form-control-sm"
                                        value="{{ old('original_name', $brand->original_name) }}">
                                </div>
                                @error('original_name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="persian_name">نام فارسی برند</label>
                                    <input type="text" name="persian_name" class="form-control form-control-sm"
                                        value="{{ old('persian_name', $brand->persian_name) }}">
                                </div>
                                @error('persian_name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="logo"> تصویر</label>
                                    <input type="file" name="logo" class="form-control form-control-sm">
                                </div>
                                @error('logo')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($brand->logo['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="currentImage"
                                                    id="{{ $number }}" value="{{ $key }}"
                                                    @if ($brand->logo['currentImage'] == $key) checked @endif>
                                                <label class="form-check-label mx-2" for="{{ $number }}">
                                                    <img src="{{ asset($value) }}" alt="" class="w-100">
                                                </label>
                                            </div>
                                        </section>
                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>
                                            غیر فعال</option>
                                        <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>
                                            فعال</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                        value="{{ old('tags', $brand->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple></select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    <script>
        $(document).ready(function() {

            let tags_input = $('#tags');
            let select_tags = $('#select_tags');
            let default_tags = tags_input.val();
            let default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ ها را وارد کنید',
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function() {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    let selected_source = select_tags.val().join(',');
                    tags_input.val(selected_source);
                }
            })

        })
    </script>
@endsection
