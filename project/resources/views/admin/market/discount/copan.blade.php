@extends('admin.layouts.master')

@section('head-tag')
    <title>کوپن تخفیف </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کوپن تخفیف</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>کوپن تخفیف </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.discount.copan.create') }}" class="btn btn-info btn-sm"> ایجاد کوپن تخفیف جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">کد کوپن </th>
                                <th scope="col">میزان تخفیف </th>
                                <th scope="col">نوع تخفیف </th>
                                <th scope="col">سقف تخفیف </th>
                                <th scope="col">نوع کوپن </th>
                                <th scope="col">تاریخ شروع</th>
                                <th scope="col">تاریخ پایان</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($copans as $copan)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $copan->code }} </td>
                                <td>{{ $copan->amount}}</td>
                                <td>{{ $copan->amount_type == 0 ? 'درصدی' : 'عددی' }} </td>
                                <th>{{ $copan->discount_ceiling ?? '-' }} </th>
                                <td> {{ $copan->type == 0 ? 'عمومی' : 'خصوصی' }} </td>
                                <td>{{ jalaliDate($copan->start_date) }}</td>
                                <td>{{ jalaliDate($copan->end_date) }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.discount.copan.edit', $copan->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <form action="{{ route('admin.market.discount.copan.destroy',$copan->id) }}" method="post" class="d-inline">
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
