@extends('admin.layouts.master')

@section('head-tag')
    <title>منو ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> منو ها </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>منو ها</h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.menu.create') }}" class="btn btn-info btn-sm">ایجاد منو جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام منو</th>
                                <th scope="col">منو والد </th>
                                <th scope="col">لینک منو</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $key => $menu)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->parent_id ? $menu->parent->name : 'منو اصلی' }}</td>
                                    <td>{{ $menu->url }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $menu->id }}" onchange="changeStatus({{ $menu->id }})"
                                                data-url="{{ route('admin.content.menu.status', $menu->id) }}"
                                                type="checkbox" @if ($menu->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.menu.edit',$menu->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <form action="{{ route('admin.content.menu.destroy',$menu->id) }}" class="d-inline" method="post">
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

            let input_status = $('#' + id);
            let url = input_status.attr('data-url');
            let elementValue = !input_status.prop('checked');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            input_status.prop('checked', true);
                            successToast('منو با موفقیت فعال شد');

                        } else {

                            input_status.prop('checked', false);
                            successToast('منو با موفقیت غیر فعال شد');
                        }

                    } else {

                        input_status.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {

                    input_status.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد');
                }
            })
        }

        function successToast(message) {
            let successToastElements = ' <section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                '<strong class="ml-auto">' + message + '</strong>\n' +
                ' <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                '  <span aria-hidden="true">&times;</span>' +
                ' </button>\n' +
                ' </section>\n' +
                '</section>\n';

            $('.toast-wrapper').append(successToastElements);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            });
        }

        function errorToast(message) {
            let errorToastElements = ' <section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                '<strong class="ml-auto">' + message + '</strong>\n' +
                ' <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                '  <span aria-hidden="true">&times;</span>\n' +
                ' </button>\n' +
                ' </section>\n' +
                '</section>\n';

            $('.toast-wrapper').append(errorToastElements);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            });
        }
    </script>
      @include('admin.alerts.sweetalert.confirm-delete',['className'=>'delete'])
@endsection
