@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد سطح دسترسی ادمین</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد سطح دسترسی ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد سطح دسترسی ادمین
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.admin-user.permissions.store',$admin->id) }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="tags">سطح دسترسی ها</label>

                                    <select class="select2 form-control form-control-sm" name="permissions[]" id="select_permissions" multiple>
                                         @foreach ($permissions as $permission)
                                           <option value="{{ $permission->id }}" @foreach($admin->permissions as $user_permission)
                                            @if ($user_permission->id == $permission->id)
                                                selected
                                            @endif
                                            @endforeach>{{ $permission->name }}</option>
                                         @endforeach
                                    </select>
                                </div>
                                @error('permissions')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm mt-md-4 px-4">ثبت</button>
                            </section>

                        </section>

                    </form>
                </section>


            </section>
        </section>
    </section>
@endsection

@section('script')
<script>
    $('#select_permissions').select2({

        placeholder:'لطفا دسترسی را انتخاب کنید',
        multiple:true
    })
    select2
</script>
@endsection
