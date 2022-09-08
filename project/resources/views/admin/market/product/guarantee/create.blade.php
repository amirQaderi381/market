@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد گارانتی کالا</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> گارانتی کالا</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد گارانتی کالا </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد گارانتی کالا</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.guarantee.index',$product->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.guarantee.store',$product->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="name">نام گارانتی</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
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
                                    <label for="price_increase">افزایش قیمت</label>
                                    <input type="text" name="price_increase" value="{{ old('price_increase') }}"
                                        class="form-control form-control-sm">
                                </div>
                                @error('price_increase')
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
