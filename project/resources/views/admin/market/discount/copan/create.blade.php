@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> روش های ارسال</a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد روش ارسال</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد روش ارسال</h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="#">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">نام روش ارسال</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">هزینه ارسال</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </div>
@endsection
