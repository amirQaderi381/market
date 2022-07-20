<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.heade-tags')
    @yield('head-tag')
</head>

<body dir="rtl">

    @include('admin.layouts.header')

    <section class="body-container">

        @include('admin.layouts.sidebar')

        <section class="main-body">

            @yield('content')

        </section>

    </section>

    @include('admin.layouts.scripts')
    @yield('script')

    <section class="toast-wrapper flex-row-reverse">
         @include('admin.alerts.toast.success')
         @include('admin.alerts.toast.error')
    </section>

    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')
</body>

</html>
