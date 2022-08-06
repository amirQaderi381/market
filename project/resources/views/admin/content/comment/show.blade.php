@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> نظرات </a> </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرها </li>
        </ol>
    </nav>

    <div class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش نظر </h5>
                </section>

                <section class="mt-4 mb-3 pb-2 border-bottom">
                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-yellow">
                        {{ $comment->user->fullName }} - {{ $comment->user->id }}
                    </section>

                    <section class="card-body">
                        <h5>مشخصات پست : {{ $comment->commentable->title }} و کد پست : {{ $comment->commentable_id }}</h5>
                        <p>{{ $comment->body }}</p>
                    </section>
                </section>

                @if ($comment->parent_id == null)
                    <section>
                        <form action="{{ route('admin.content.comment.answer', $comment->id) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="body">پاسخ ادمین </label>
                                    <textarea class="form-control form-control-sm" rows="4" name="body"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                        </form>
                    </section>
                @endif

            </section>
        </section>
    </div>
@endsection
