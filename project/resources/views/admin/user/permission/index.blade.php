@extends('admin.layouts.master')

@section('head-tag')
    <title>دسترسی ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسترسی ها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.permission.create') }}" class="btn btn-info btn-sm">ایجاد دسترسی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام دسترسی</th>
                                <th scope="col">توضیحات دسترسی</th>
                                <th scope="col">نام نقش ها</th>
                                <th scope="col" class="max-width-16-rem text-center"><i class="fas fa-cogs"></i> تنظیمات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $permission)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>
                                        <ol class="px-2">
                                            @if (empty($permission->roles()->get()->toArray()))
                                                <span class="text-danger">برای این دسترسی هیچ نقشی تعریف نشده است</span>
                                            @else
                                                @foreach ($permission->roles as $role)
                                                    <li>{{ $role->name }}</li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </td>
                                    <td class="width-20-rem text-left">

                                        <a href="{{ route('admin.user.permission.edit',$permission->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> ویرایش
                                        </a>
                                        <form action="{{ route('admin.user.permission.destroy',$permission->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete" type="submit">
                                                <i class="fa fa-trash-alt"></i> حذف
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
  @include('admin.alerts.sweetalert.confirm-delete',['className'=>'delete'])
@endsection
