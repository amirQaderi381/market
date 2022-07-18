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
                    <form action="{{route('admin.content.category.update',[$postCategory->id])}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        {{method_field('put')}}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">نام دسته</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{old('name',$postCategory->name)}}">
                                @error('name')
                                    <span class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tags">تگ ها</label>
                                <input type="text" class="form-control form-control-sm" name="tags" id="tags" value="{{old('tags',$postCategory->tags)}}">
                                @error('tags')
                                    <span class="alert alert-danger">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">وضعیت</label>
                                <select id="status" class="form-control form-control-sm" name="status">
                                    <option value="0" {{ old('status',$postCategory->status) == 0 ? 'selected' : '' }}>غیر فعال</option>
                                    <option value="1" {{ old('status',$postCategory->status) == 1 ? 'selected' : '' }} >فعال</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>

                            <div class="form-group col-12">
                                <label for="description">توضیحات</label>
                                <textarea class="form-control form-control-sm" name="description" id="description" rows="4" >
                                    {{old('description',$postCategory->description)}}
                                </textarea>
                                @error('description')
                                    <span class="alert alert-danger">
                                        <strong>{{$message}}</strong>
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
<script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('description')
</script>
@endsection
