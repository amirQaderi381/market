@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کالا</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> کالا</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کالا </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کالا</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.product.update',$product->id) }}" method="post" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="name">نام کالا</label>
                                    <input type="text" name="name" value="{{ old('name',$product->name) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="category_id">دسته کالا</label>
                                    <select id="category_id" name="category_id" class="form-control form-control-sm">
                                        <option value="" selected>دسته را انتخاب کنید...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id',$product->category_id) == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="brand_id">برند کالا</label>
                                    <select id="brand_id" name="brand_id" class="form-control form-control-sm">
                                        <option value="" selected>برند را انتخاب کنید...</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @if (old('brand_id',$product->brand_id) == $brand->id) selected @endif>
                                                {{ $brand->original_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('brand_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="image"> تصویر</label>
                                    <input type="file" name="image"
                                        class="form-control form-control-sm "id="image">
                                </div>
                                @error('image')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($product->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="currentImage"
                                                    id="{{ $number }}" value="{{ $key }}"
                                                    @if ($product->image['currentImage'] == $key) checked @endif>
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

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="weight">وزن</label>
                                    <input type="text" name="weight" value="{{ old('weight',$product->weight) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('weight')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="length">طول</label>
                                    <input type="text" name="length" value="{{ old('length',$product->length) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('length')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="width">عرض</label>
                                    <input type="text" name="width" value="{{ old('width',$product->width) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('width')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="height">ارتفاع</label>
                                    <input type="text" name="height" value="{{ old('height',$product->height) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('height')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="price">قیمت کالا</label>
                                    <input type="text" name="price" value="{{ old('price',$product->price) }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('price')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="introduction">توضیحات</label>
                                    <textarea class="form-control form-control-sm" name="introduction" id="introduction" rows="6">
                                        {{ old('introduction',$product->introduction) }}
                                    </textarea>
                                </div>
                                @error('introduction')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status',$product->status) == 0 ? 'selected' : '' }}>غیر فعال
                                        </option>
                                        <option value="1" {{ old('status',$product->status) == 1 ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="marketable">وضعیت قابل فروش</label>
                                    <select id="marketable" class="form-control form-control-sm" name="marketable">
                                        <option value="0" {{ old('marketable',$product->marketable) == 0 ? 'selected' : '' }}>غیر فعال
                                        </option>
                                        <option value="1" {{ old('marketable',$product->marketable) == 1 ? 'selected' : '' }}>فعال
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags"
                                        id="tags" value="{{ old('tags',$product->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags"
                                        multiple></select>
                                </div>
                                @error('tags')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="published_at">تاریخ انتشار</label>
                                    <input type="text" class="form-control form-control-sm d-none" id="published_at"
                                        name="published_at" >
                                    <input type="text" class="form-control form-control-sm" id="published_at_view" value="{{ old('published_at',$product->published_at) }}">
                                </div>
                                @error('published_at')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <div class="form-group col-12 border-top border-bottom py-3 mb-3">
                            @foreach($product->metas as $meta)
                                <div class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_names[{{ $meta->id }}]" value="{{ $meta->meta_name }}" class="form-control form-control-sm">
                                        </div>
                                    </section>
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_values[]" value="{{ $meta->meta_value }}" class="form-control form-control-sm">
                                        </div>
                                    </section>
                                </div>
                            @endforeach
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
    <script src="{{ asset('admin_assets/datepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin_assets/datepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction')
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

    <script>
        let element = $('.btn-copy');
        element.on('click',function(){
            let element = $(this).parent().prev().clone(true);
            $(this).before(element)
        })
    </script>
@endsection
