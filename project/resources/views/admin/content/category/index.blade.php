@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
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
                    <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
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
                                <th scope="col">نوضیحات</th>
                                <th scope="col">اسلاگ</th>
                                <th scope="col">تصویر</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تگ ها</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postCategories as $postCategory)
                                <tr>
                                    <th>1</th>
                                    <td>{{ $postCategory->name }}</td>
                                    <td>{{ $postCategory->description }}</td>
                                    <td>{{ $postCategory->slug }}</td>
                                    <td>
                                        <img src="{{ asset($postCategory->description) }}" alt="" width="50"
                                            height="50">
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $postCategory->id }}"
                                                onchange="changeStatus({{ $postCategory->id }})"
                                                data-url="{{ route('admin.content.category.status', $postCategory->id) }}"
                                                type="checkbox" @if ($postCategory->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>{{ $postCategory->tags }}</td>
                                    <td class="width-16-rem text-left">

                                        <a href="{{ route('admin.content.category.edit', [$postCategory->id]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>

                                        <form class="d-inline"
                                            action="{{ route('admin.content.category.destroy', [$postCategory->id]) }}"
                                            method="POST">
                                            @csrf
                                            {{ method_field('delete') }}
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
    </script>

    @include('admin.alerts.sweetalert.confirm-delete', ['className' => 'delete']);
@endsection
