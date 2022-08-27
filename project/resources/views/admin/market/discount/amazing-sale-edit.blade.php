@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش فروش شگفت انگیز</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروش شگفت انگیز</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش فروش شگفت انگیز</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش فروش شگفت انگیز</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.amazing.sale') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.amazing.sale.update',$amazingSale->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="product_id">انتخاب کالا</label>
                                    <select id="product_id" name="product_id" class="form-control form-control-sm">
                                        <option value="" selected>کالا را انتخاب کنید...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                @if (old('product_id',$amazingSale->product_id) == $product->id) selected @endif>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">درصد تخفیف</label>
                                    <input type="text" name="percentage" class="form-control form-control-sm mb-2" value="{{ old('percentage',$amazingSale->percentage) }}">
                                </div>
                                @error('percentage')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="start_date">تاریخ شروع</label>
                                    <input type="hidden" class="form-control form-control-sm" id="start_date"
                                        name="start_date">
                                    <input type="text" class="form-control form-control-sm" id="start_date_view" value="{{ old('start_date',$amazingSale->start_date) }}">
                                </div>
                                @error('start_date')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="end_date">تاریخ پایان</label>
                                    <input type="hidden" class="form-control form-control-sm" id="end_date"
                                        name="end_date">
                                    <input type="text" class="form-control form-control-sm" id="end_date_view"  value="{{ old('end_date',$amazingSale->end_date) }}">
                                </div>
                                @error('end_date')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>غیر فعال
                                        </option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>
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

<script src="{{ asset('admin_assets/datepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('admin_assets/datepicker/persian-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function(){

        $('#start_date_view').persianDatepicker({
         format: 'YYYY/MM/DD',
         altField: '#start_date'
         });

         $('#end_date_view').persianDatepicker({
         format: 'YYYY/MM/DD',
         altField: '#end_date'
         });
    })


 </script>

@endsection
