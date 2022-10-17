@extends('customer.layouts.master-two-col')


@section('head-tag')
<title>حساب کاربری</title>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
           @include('customer.layouts.partials.profile-sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header mb-4">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>اطلاعات حساب</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    <section class="d-flex justify-content-end my-4">
                        <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" data-bs-toggle="modal" data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش حساب</a>
                    </section>


                    <section class="row">
                        <section class="col-6 border-bottom mb-2 py-2">
                            <section class="field-title">نام</section>
                            <section class="field-value overflow-auto">{{ auth()->user()->first_name ?? '-' }}</section>
                        </section>

                        <section class="col-6 border-bottom my-2 py-2">
                            <section class="field-title">نام خانوادگی</section>
                            <section class="field-value overflow-auto">{{ auth()->user()->last_name ?? '-' }}</section>
                        </section>

                        <section class="col-6 border-bottom my-2 py-2">
                            <section class="field-title">شماره تلفن همراه</section>
                            <section class="field-value overflow-auto">{{ auth()->user()->mobile ?? '-' }}</section>
                        </section>

                        <section class="col-6 border-bottom my-2 py-2">
                            <section class="field-title">ایمیل</section>
                            <section class="field-value overflow-auto">{{ auth()->user()->email ?? '-' }}</section>
                        </section>

                        <section class="col-6 my-2 py-2">
                            <section class="field-title">کد ملی</section>
                            <section class="field-value overflow-auto">{{ auth()->user()->national_code ?? '-' }}</section>
                        </section>

                    </section>

                    <section class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                        <section class="modal-dialog">
                            <section class="modal-content">
                                <section class="modal-header">
                                    <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ویرایش حساب کاربری</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </section>
                                <section class="modal-body">
                                    <form class="row" action="{{ route('customer.profile.profile.update') }}" method="post">
                                     @csrf
                                     @method('put')

                                        <section class="col-12 mb-2">
                                            <label for="first_name" class="form-label mb-1">نام</label>
                                            <input type="text" name="first_name" class="form-control form-control-sm" value="{{ auth()->user()->first_name ?? '-' }}" id="first_name" placeholder="نام"></input>
                                        </section>


                                        <section class="col-6 mb-2">
                                            <label for="last_name" class="form-label mb-1">نام خانوادگی </label>
                                            <input type="text" name="last_name" value="{{ auth()->user()->last_name ?? '-' }}" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی ">
                                        </section>

                                        <section class="col mb-2">
                                            <label for="mobile" class="form-label mb-1">کد ملی</label>
                                            <input type="text" name="national_code" value="{{ auth()->user()->national_code ?? '-' }}" class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                        </section>

                                        <section class="modal-footer py-1">
                                         <button type="submit" class="btn btn-sm btn-primary">ثبت</button>
                                         <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>

                                     </section>
                                    </form>
                                </section>

                            </section>
                        </section>
                    </section>

                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->
@endsection
