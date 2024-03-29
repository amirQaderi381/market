@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>دسته بندی</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.market.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام دسته بندی</th>
                                <th scope="col">دسته والد</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">وضعیت نمایش در منو</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($product_categories as $productCategory)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $productCategory->name }}</td>
                                <td>{{ $productCategory->parent == null ? 'دسته اصلی' : $productCategory->parent->name }}</td>
                                <td>
                                    <label>
                                        <input id="{{ $productCategory->id }}"
                                            onchange="changeStatus({{ $productCategory->id }})"
                                            data-url="{{ route('admin.market.category.status', $productCategory->id) }}"
                                            type="checkbox" @if ($productCategory->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input id="show_in_menu_{{ $productCategory->id }}"
                                            onchange="showInMenu({{ $productCategory->id }})"
                                            data-url="{{ route('admin.market.category.show-in-menu', $productCategory->id) }}"
                                            type="checkbox" @if ($productCategory->show_in_menu === 1) checked @endif>
                                    </label>
                                </td>
                                <td class="max-width-16-rem text-left">
                                    <a href="{{ route('admin.market.category.show',$productCategory->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-eye"></i> مشاهده
                                    </a>
                                    <a href="{{ route('admin.market.category.edit',$productCategory->id) }}" class="btn btn-primary btn-sm text-white">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>

                                    <form action="{{ route('admin.market.category.destroy',$productCategory->id) }}" method="post" class="d-inline">
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
                            successToast('دسته بندی با موفقیت فعال شد')

                        } else {
                            status_input.prop('checked', false);
                            successToast('دسته بندی با موفقیت غیر فعال شد')
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

        function showInMenu(id) {
            let status_input = $('#show_in_menu_' + id);
            let url = status_input.attr('data-url')
            let elementValue = !status_input.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.show_in_menu) {
                        if (response.checked) {
                            status_input.prop('checked', true);
                            successToast('نمایش در منو با موفقیت فعال شد')

                        } else {
                            status_input.prop('checked', false);
                            successToast('نمایش در منو با موفقیت غیر فعال شد')
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
