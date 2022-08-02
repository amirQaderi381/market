@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پست</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش پست
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.post.update', [$post->id]) }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title">عنوان پست</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                        value="{{ old('title', $post->title) }}">
                                </div>
                                @error('title')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}"
                                                @if ($postCategory->id == old('category_id', $post->category_id)) selected @endif>{{ $postCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
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
                                <section>
                                    <div class="row">
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($post->image['indexArray'] as $key => $value)
                                            <section class="col-md-{{ 6 / $number }}">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="currentImage"
                                                        id="{{ $number }}" value="{{ $key }}"
                                                        @if ($post->image['currentImage'] == $key) checked @endif>
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
                                </section>
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <section class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select class="form-control form-control-sm" name="status" id="status">
                                        <option value="0" @if (old('status', $post->status) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('status', $post->status) == 1) selected @endif>فعال
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

                            <section class="col-12 col-md-6 my-2">
                                <section class="form-group">
                                    <label for="commentable">امکان درج کامنت</label>
                                    <select class="form-control form-control-sm" name="commentable" id="commentable">
                                        <option value="0" @if (old('commentable', $post->commentable) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('commentable', $post->commentable) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </section>
                                @error('commentable')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="published_at">تاریخ انتشار</label>
                                    <input type="text" class="form-control form-control-sm d-none" id="published_at"
                                        name="published_at" value="{{ old('published_at', $post->published_at) }}">
                                    <input type="text" class="form-control form-control-sm" id="published_at_view">
                                </div>
                                @error('published_at')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <input type="text" class="form-control form-control-sm d-none" name="tags"
                                        id="tags" value="{{ old('tags', $post->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags"
                                        multiple></select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="summary">خلاصه پست</label>
                                    <textarea name="summary" id="summary" class="form-control form-control-sm" rows="6">{{ old('summary', $post->summary) }}</textarea>
                                </div>
                                @error('summary')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="body">متن پست</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body', $post->body) }}</textarea>
                                </div>
                                @error('body')
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
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin_assets/datepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin_assets/datepicker/persian-datepicker.min.js') }}"></script>

    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

    <script>
        $(document).ready(function() {

            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            });
        })
    </script>

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
