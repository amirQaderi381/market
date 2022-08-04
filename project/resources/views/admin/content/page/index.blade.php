@extends('admin.layouts.master')

@section('head-tag')
    <title>پیج ساز</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پیج ساز</li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پیج ساز</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.page.create') }}" class="btn btn-info btn-sm">ایجاد پیج جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">اسلاگ</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">برچسب ها</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $page->id }}" onchange="changeStatus({{ $page->id }})"
                                                data-url="{{ route('admin.content.page.status', $page->id) }}"
                                                type="checkbox" @if ($page->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td>{{ $page->tags }}</td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.page.edit',$page->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>

                                        <form action="{{ route('admin.content.page.destroy',$page->id) }}" method="POST" class="d-inline">
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
    <script>
        function changeStatus(id) {
            let element = $('#' + id);
            let url = element.attr('data-url');
            let elementValue = !element.prop('checked');

            $.ajax({

                type: 'GET',
                url: url,
                success: function(response) {

                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('پیج با موفقیت فعال شد')

                        } else {

                            element.prop('checked', false);
                            successToast('پیج با موفقیت غیر فعال شد')
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
            })
        }

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
    </script>
    @include('admin.alerts.sweetalert.confirm-delete',['className'=>'delete'])
@endsection
