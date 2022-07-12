@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> دسته بندی</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسته بندی</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد دسته بندی</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">نام دسته</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tags">تگ ها</label>
                                <input type="text" class="form-control form-control-sm" name="tags" id="tags">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">وضعیت</label>
                                <select id="status" class="form-control form-control-sm">
                                    <option selected>غیر فعال</option>
                                    <option>فعال</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>

                            <div class="form-group col-12">
                                <label for="description">نوضیحات</label>
                                <textarea class="form-control form-control-sm" name="description" id="description" rows="4"></textarea>
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
