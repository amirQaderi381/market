@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> تخفیف عمومی</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف عمومی</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش تخفیف عمومی</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.common.discount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.common.discount.update',$commonDiscount->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">درصد تخفیف</label>
                                    <input type="text" name="percentage" class="form-control form-control-sm mb-2" value="{{ old('percentage',$commonDiscount->percentage) }}">
                                </div>
                                @error('percentage')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">حداکثر تخفیف</label>
                                    <input type="text" name="discount_ceiling" class="form-control form-control-sm" value="{{ old('discount_ceiling',$commonDiscount->discount_ceiling) }}">
                                </div>
                                @error('discount_ceiling')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">حداقل مبلغ خرید</label>
                                    <input type="text" name="minimal_order_amount" class="form-control form-control-sm" value="{{ old('minimal_order_amount',$commonDiscount->minimal_order_amount) }}">
                                </div>
                                @error('minimal_order_amount')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">عنوان مناسبت</label>
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title',$commonDiscount->title) }}">
                                 </div>
                                 @error('title')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="start_date"> تاریخ شروع</label>
                                    <input type="hidden" name="start_date" class="form-control form-control-sm"
                                        id="start_date">
                                    <input type="tedxt" class="form-control form-control-sm" id="start_date_view" value="{{ old('start_date',$commonDiscount->start_date) }}">
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
                                    <input type="hidden" name="end_date" class="form-control form-control-sm" id="end_date">
                                    <input type="text" class="form-control form-control-sm" id="end_date_view" value="{{ old('end_date',$commonDiscount->end_date) }}">
                                </div>
                                @error('end_date')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status',$commonDiscount->status) == 0 ? 'selected' : '' }}>غیر فعال
                                        </option>
                                        <option value="1" {{ old('status',$commonDiscount->status) == 1 ? 'selected' : '' }}>فعال</option>
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
