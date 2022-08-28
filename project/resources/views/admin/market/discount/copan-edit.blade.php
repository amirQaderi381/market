@extends('admin.layouts.master')

@section('head-tag')
    <title>کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/datepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> کوپن تخفیف</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کوپن تخفیف</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.copan.update',$copan->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">کد کوپن </label>
                                    <input type="text" name="code" class="form-control form-control-sm" value="{{ old('code',$copan->code) }}">
                                </div>
                                @error('code')
                                   <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-2 type">
                                <label for="">نوع کوپن</label>
                                <select id="type" name="type" class="form-control form-control-sm">
                                    <option value="0" {{ old('type',$copan->type) == 0 ? 'selected' : '' }} >عمومی</option>
                                    <option value="1" {{ old('type',$copan->type) == 1 ? 'selected' : '' }}>خصوصی</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">میزان تخفیف</label>
                                    <input type="text" name="amount" class="form-control form-control-sm" value="{{ old('amount',$copan->amount) }}">
                                </div>
                                @error('amount')
                                   <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                 <div class="form-group">
                                    <label for="">نوع تخفیف</label>
                                    <select name="amount_type" class="form-control form-control-sm">
                                        <option value="0" {{ old('amount_type',$copan->amount_type) == 0 ? 'selected' : '' }} >درصدی</option>
                                        <option value="1" {{ old('amount_type',$copan->amount_type) == 1 ? 'selected' : '' }}>عددی</option>
                                    </select>
                                 </div>
                                 @error('amount_type')
                                   <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">حداکثر تخفیف</label>
                                    <input type="text" name="discount_ceiling" class="form-control form-control-sm" value="{{ old('discount_ceiling',$copan->discount_ceiling) }}">
                                </div>
                                @error('discount_ceiling')
                                   <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="start_date">تاریخ شروع</label>
                                    <input type="hidden" class="form-control form-control-sm" id="start_date"
                                        name="start_date">
                                    <input type="text" class="form-control form-control-sm" id="start_date_view" value="{{ old('start_date',$copan->start_date) }}">
                                </div>
                                @error('start_date')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="end_date">تاریخ پایان</label>
                                    <input type="hidden" class="form-control form-control-sm" id="end_date"
                                        name="end_date">
                                    <input type="text" class="form-control form-control-sm" id="end_date_view"  value="{{ old('end_date',$copan->end_date) }}">
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
                                        <option value="0" {{ old('status',$copan->status) == 0 ? 'selected' : '' }}>غیر فعال
                                        </option>
                                        <option value="1" {{ old('status',$copan->status) == 1 ? 'selected' : '' }}>فعال</option>
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

        function createUsersSelectBox()
        {
            let element = '<div class="col-md-6 element mb-2">' +
            '<div class="form-group">'+
            '<label for=""> کاربران</label>' +
            '<select name="user_id" id="type" class="form-control form-control-sm">' +
            '<option value=" " >کاربر انتخاب کنید</option>' +
            ' @foreach ($users as $user)'+
            ' <option @if(old("user_id",$copan->user_id) == $user->id) selected @endif value="{{ $user->id }}">{{ $user->fullName }}</option>' +
            ' @endforeach'+
            ' </select>' +
            '</div>'+
            ' @error("user_id")'+
            '<span class="alert_required bg-danger text-white p-1 rounded" role="alert">'+
            '<strong>{{ $message }}</strong>'+
            ' </span>'+
            ' @enderror'+
            '</div>';

            $(element).insertAfter('.type');
        }

        if($('#type').find(':selected').val() == 1){

          createUsersSelectBox()
        }


        $('#type').change(function() {

            if($('#type').find(':selected').val() == 1){

              createUsersSelectBox()

            }else{

               $(".element").remove();
            }
        })

    </script>

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
