@extends('admin.layouts.master')

@section('head-tag')
    <title>تخفیف عمومی </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تخفیف عمومی </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>تخفیف عمومی </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.common.discount.create') }}" class="btn btn-info btn-sm">
                        ایجاد
                        تخفیف عمومی
                        جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">درصد تخفیف </th>
                                <th scope="col">سقف تخفیف </th>
                                <th scope="col">عنوان مناسبت </th>
                                <th scope="col">تاریخ شروع</th>
                                <th scope="col">تاریخ پایان</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($commonDiscounts as $commonDiscount)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $commonDiscount->percentage }}% </td>
                                <td>{{ $commonDiscount->discount_ceiling }} تومان </td>
                                <td>{{ $commonDiscount->title }}</td>
                                <td>{{ jalaliDate($commonDiscount->start_date) }}</td>
                                <td>{{  jalaliDate($commonDiscount->end_date) }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.discount.common.discount.edit',$commonDiscount->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <form action="{{ route('admin.market.discount.common.discount.destroy',$commonDiscount->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm delete">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </div>
@endsection

@section('script')
  @include('admin.alerts.sweetalert.confirm-delete',['className'=>'delete'])
@endsection
