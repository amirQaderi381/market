@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
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
                    <a href="{{ route('admin.market.comment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header bg-custom-yellow">
                        {{ $comment->user->fullName }}  - {{ $comment->author_id }}
                    </section>

                    <section class="card-body">
                        <h5>مشخصات کالا :{{ $comment->commentable->name }}  کد کالا : {{ $comment->commentable_id }}</h5>
                        <p>{{ $comment->body }}</p>
                    </section>
                </section>

            @if ($comment->parent_id == null)
                <section>
                    <form action="{{ route('admin.market.comment.answer',$comment->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">پاسخ ادمین </label>
                                <textarea class="form-control form-control-sm" name="body" rows="4"></textarea>
                            </div>
                            @error('body')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm px-5">ثبت</button>
                    </form>
                </section>
            @endif
            </section>
        </section>
    </div>
@endsection
