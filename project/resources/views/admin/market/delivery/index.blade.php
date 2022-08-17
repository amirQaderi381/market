@extends('admin.layouts.master')

@section('head-tag')
    <title>روش های ارسال </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> روش های ارسال</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5> روش های ارسال</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.delivery.create') }}" class="btn btn-info btn-sm"> ایجاد روش ارسال
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
                                <th scope="col">نام روش ارسال</th>
                                <th scope="col">هزینه ارسال</th>
                                <th scope="col">زمان ارسال</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($delivery_methods as $delivery)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $delivery->name }}</td>
                                <td>{{ $delivery->amount }} تومان </td>
                                <td>{{ $delivery->delivery_time . ' ' .$delivery->delivery_time_unit }}</td>
                                <td>
                                    <label>
                                        <input id="{{ $delivery->id }}"
                                            onchange="changeStatus({{ $delivery->id }})"
                                            data-url="{{ route('admin.market.delivery.status', $delivery->id) }}"
                                            type="checkbox" @if ($delivery->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.delivery.edit',$delivery->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <form action="{{ route('admin.market.delivery.destroy',$delivery->id) }}" method="post" class="d-inline">
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

    <script type="text/javascript">

        function changeStatus(id) {
            let element = $('#' + id);
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('روش ارسال با موفقیت فعال شد')

                        } else {
                            element.prop('checked', false);
                            successToast('روش ارسال با موفقیت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد');
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            };

            function errorToast(message) {
                let errorToastTags = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(errorToastTags);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                });
            }

        }
    </script>

    @include('admin.alerts.sweetalert.confirm-delete', ['className' => 'delete'])

@endsection

