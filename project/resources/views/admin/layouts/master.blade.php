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

</body>

</html>
