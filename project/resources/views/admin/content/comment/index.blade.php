@extends('admin.layouts.master')

@section('head-tag')
    <title> نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نظرات </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر جدید</a>
                    <div>
                        <input type="text" class="form-control form-control-sm max-width-16-rem" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نظر</th>
                                <th scope="col">پاسخ به</th>
                                <th scope="col">کد کابر </th>
                                <th scope="col">نویسنده نظر</th>
                                <th scope="col">کد پست</th>
                                <th scope="col">پست</th>
                                <th scope="col">وضعیت تایید</th>
                                <th scope="col">وضعیت نظر</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($comments as $key=>$comment)
                                <tr>
                                    <th>{{ $key += 1 }}</th>
                                    <td>{{ Str::limit($comment->body, 10, '...') }}</td>
                                    <td>{{ $comment->parent_id ? Str::limit($comment->parent->body, 10, '...') : ' ' }}</td>
                                    <td>{{ $comment->author_id }}</td>
                                    <td>{{ $comment->user->fullName }}</td>
                                    <td>{{ $comment->commentable_id }}</td>
                                    <td>{{ $comment->commentable->title }}</td>
                                    <td>{{ $comment->approved == 1 ? 'تایید شده' : 'در انتظار تایید' }}</td>
                                    <td>
                                        <label>
                                            <input id="{{ $comment->id }}"
                                                onchange="changeStatus({{ $comment->id }})"
                                                data-url="{{ route('admin.content.comment.status', $comment->id) }}"
                                                type="checkbox" @if ($comment->status === 1) checked @endif>
                                        </label>
                                    </td>
                                    <td class="width-16-rem text-left">
                                        <a href="{{ route('admin.content.comment.show',$comment->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> نمایش
                                        </a>

                                        @if ($comment->approved == 1)
                                            <a href="{{ route('admin.content.comment.approved',$comment->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-clock"></i> عدم تایید
                                            </a>
                                        @else
                                            <a href="{{ route('admin.content.comment.approved',$comment->id) }}" class="btn btn-success btn-sm px-3 text-white">
                                                <i class="fas fa-check"></i> تایید
                                            </a>
                                        @endif
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
                            successToast('نظر با موفقیت فعال شد')

                        } else {
                            status_input.prop('checked', false);
                            successToast('نظر با موفقیت غیر فعال شد')
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

@endsection
