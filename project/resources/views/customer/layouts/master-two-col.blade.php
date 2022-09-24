<!DOCTYPE html>
<html lang="en">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>



    @include('customer.layouts.header')


    <section class="container-xxl body-container">
        @yield('customer.layouts.sidebar')
    </section>

    <main id="main-body-one-col" class="main-body">

       @yield('content')
       {{-- <section class="toast-wrapper position-fixed p-4 flex-row-reverse" style="z-index: 909999999;right: 0; top: 3rem; width: 26rem; max-width: 80%;">
       </section> --}}


    </main>


    @include('customer.layouts.footer')


    @include('customer.layouts.script')

    @yield('script')

    <section class="toast-wrapper flex-row-reverse">
        @include('customer.alerts.toast.success')
    </section>

    @include('customer.alerts.sweetalert.success')
    @include('customer.alerts.sweetalert.error')

</body>
</html>
