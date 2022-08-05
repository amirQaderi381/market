@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش منو</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> منو</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش منو</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.menu.update',$menu->id) }}" method="post">
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="name">عنوان منو</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                        value="{{ old('name',$menu->name) }}">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="parent_id">منو والد</label>
                                    <select id="parent_id" name="parent_id" class="form-control form-control-sm">
                                        <option value="">منو اصلی</option>
                                        @foreach ($parent_menus as $parent_menu)
                                            <option value="{{ $parent_menu->id }}"
                                                @if (old('parent_id',$menu->parent_id) == $parent_menu->id) selected @endif>{{ $parent_menu->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <label for="url">آدرس url</label>
                                    <input type="text" class="form-control form-control-sm" name="url" value="{{ old('url',$menu->url) }}">
                                </div>
                                @error('url')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status',$menu->status) == 0 ? 'selected' : '' }}>غیر فعال</option>
                                        <option value="1" {{ old('status',$menu->status) == 1 ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5 my-2">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </div>
@endsection
