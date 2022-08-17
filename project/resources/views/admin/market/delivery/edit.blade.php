@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> روش های ارسال</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش روش ارسال</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش روش ارسال</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.delivery.update',$delivery->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">نام روش ارسال</label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name',$delivery->name) }}">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">هزینه ارسال</label>
                                    <input type="text" class="form-control form-control-sm" name="amount" value="{{ old('amount',$delivery->amount) }}">
                                </div>
                                @error('amount')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time">زمان ارسال</label>
                                    <input type="text" name="delivery_time" class="form-control form-control-sm" value="{{ old('delivery_time',$delivery->delivery_time) }}">
                                </div>
                                @error('delivery_time')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_time_unit">واحد زمان ارسال</label>
                                    <input type="text" name="delivery_time_unit" class="form-control form-control-sm" value="{{ old('delivery_time_unit',$delivery->delivery_time_unit) }}">
                                </div>
                                @error('delivery_time_unit')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="0" {{ old('status',$delivery->status) == 0 ? 'selected' : '' }}>غیر فعال</option>
                                        <option value="1" {{ old('status',$delivery->status) == 1 ? 'selected' : '' }}>فعال</option>
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
