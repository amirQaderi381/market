@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کاربران ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ایمیل</th>
                                <th>شماره موبایل</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>نقش</th>
                                <th>فعال سازی</th>
                                <th>وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $admin)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->mobile }} </td>
                                    <td>{{ $admin->first_name }} </td>
                                    <td>{{ $admin->last_name }} </td>
                                    <td>سوپر ادمین </td>
                                    <td>
                                        <label>
                                            <input id="{{ $admin->id }}-activation"
                                                onchange="changeActivation({{ $admin->id }})"
                                                data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                                type="checkbox" @if ($admin->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $admin->id }}" onchange="changeStatus({{ $admin->id }})"
                                                data-url="{{ route('admin.user.admin-user.status', $admin->id) }}"
                                                type="checkbox" @if ($admin->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-22-rem text-left">
                                        <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                                        <a href="{{ route('admin.user.admin-user.edit',$admin->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>  ویرایش
                                        </a>
                                       <form action="{{ route('admin.user.admin-user.destroy',$admin->id) }}" method="post" class="d-inline">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm delete" type="submit">
                                            <i class="fa fa-trash-alt"></i>حذف
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
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        function changeActivation(id) {
            let status_input = $('#' + id + '-activation');
            let url = status_input.attr('data-url')
            let elementValue = !status_input.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.activation) {
                        if (response.checked) {
                            status_input.prop('checked', true);
                            successToast('فعال سازی ادمین با موفقیت انجام شد')

                        } else {
                            status_input.prop('checked', false);
                            successToast('غیر فعال سازی با موفقیت انجام شد')
                        }
                    } else {
                        status_input.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {
                    status_input.prop('checked', elementValue);
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

    <script type="text/javascript">
        function changeStatus(id) {
            let status_input = $('#' + id);
            let url = status_input.attr('data-url')
            let elementValue = !status_input.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            status_input.prop('checked', true);
                            successToast('ادمین با موفقیت فعال شد')

                        } else {
                            status_input.prop('checked', false);
                            successToast('ادمین با موفقیت غیر فعال شد')
                        }
                    } else {
                        status_input.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {
                    status_input.prop('checked', elementValue);
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
