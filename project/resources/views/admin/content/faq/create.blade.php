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
                    <form action="{{ route('admin.content.faq.store') }}" method="POST" id="form">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="question">پرسش</label>
                                    <input type="text" class="form-control form-control-sm " name="question"
                                        value="{{ old('question') }}">
                                </div>
                                @error('question')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="answer">پاسخ</label>
                                    <textarea class="form-control form-control-sm" name="answer" id="body" rows="4">{{ old('answer') }}</textarea>
                                </div>
                                @error('answer')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>غیر فعال</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                        value="{{ old('tags') }}">
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
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
    <script>
        let tags_input = $('#tags');
        let select_tags = $('#select_tags');
        let default_tags = tags_input.val();
        let default_data = null;

        if (default_tags !== null && default_tags.length > 0) {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder: 'لطفا برچسب ها را وارد کنید',
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
    </script>
@endsection
