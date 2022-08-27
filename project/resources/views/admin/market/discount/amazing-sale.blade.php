@extends('admin.layouts.master')

@section('head-tag')
    <title>فروش شگفت انگیز </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فروش شگفت انگیز </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>فروش شگفت انگیز </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.amazing.sale.create') }}" class="btn btn-info btn-sm">افزودن
                        کالا به لیست فروش شگفت انگیز</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام کالا </th>
                                <th scope="col">درصد تخفیف </th>
                                <th scope="col">تاریخ شروع</th>
                                <th scope="col">تاریخ پایان</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($amazingSales as $amazingSale)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $amazingSale->product->name }}</td>
                                <td>{{ $amazingSale->percentage }}%</td>
                                <td>{{ jalaliDate($amazingSale->start_date) }}</td>
                                <td>{{ jalaliDate($amazingSale->end_date) }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.discount.amazing.sale.edit',$amazingSale->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <form action="{{ route('admin.market.discount.amazing.sale.destroy',$amazingSale->id)}}" method="post" class="d-inline">
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

