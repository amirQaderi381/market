@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پیج</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> پیج ساز</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پیج </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش پیج</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.page.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.page.update',$page->id) }}" method="POST" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-row">
                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                        value="{{ old('title',$page->title) }}">
                                </div>
                                @error('title')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <div class="form-group">
                                    <label for="body">محتوی</label>
                                    <textarea class="form-control form-control-sm" name="body" id="body" rows="4">{{ old('body',$page->body) }}</textarea>
                                </div>
                                @error('body')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <section class="col-12 my-2">
                                <section class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select class="form-control form-control-sm" name="status" id="status">
                                        <option value="0" @if (old('status',$page->status) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1" @if (old('status',$page->status) == 1) selected @endif>فعال
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
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags"
                                        id="tags" value="{{ old('tags',$page->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple></select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>
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
        CKEDITOR.replace('body')
    </script>
    <script>

        let tags_input = $('#tags');
        let select_tags = $('#select_tags');
        let default_tags = tags_input.val();
        let default_data= null;

        if(default_tags !== null && default_tags.length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder:'لطفا برچسب ها را وارد کنید',
            tags:true,
            data:default_data
        })

        select_tags.children('option').attr('selected',true).trigger('change');

        $('#form').submit(function(){

            if(select_tags.val() !== null && select_tags.val().length > 0)
            {
                let selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    </script>
@endsection
