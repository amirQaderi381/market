@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> دسته بندی</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایس دسته بندی</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form id="form" action="{{ route('admin.content.category.update', [$postCategory->id]) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        {{ method_field('put') }}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">نام دسته</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    value="{{ old('name', $postCategory->name) }}">
                                @error('name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tags">تگ ها</label>
                                <input type="text" class="form-control form-control-sm" name="tags" id="tags"
                                    value="{{ old('tags', $postCategory->tags) }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple></select>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">وضعیت</label>
                                <select id="status" class="form-control form-control-sm" name="status">
                                    <option value="0"
                                        {{ old('status', $postCategory->status) == 0 ? 'selected' : '' }}>غیر فعال</option>
                                    <option value="1"
                                        {{ old('status', $postCategory->status) == 1 ? 'selected' : '' }}>فعال</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>

                            <div class="form-group col-12">
                                <label for="description">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="description" id="description" rows="4">
                                    {{ old('description', $postCategory->description) }}
                                </textarea>
                                @error('description')
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
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description')
    </script>
    <script>
        $(document).ready(function() {

            let tags_input = $('#tags');
            let select_tags = $('#select_tags');
            let default_tags = tags_input.val();
            let default_data = null;

            if (default_tags !== null && default_tags.length > 0) {
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
                    let selectedsource = select_tags.val().join(',');
                    tags_input.val(selectedsource);
                }
            })
        })
    </script>
@endsection
