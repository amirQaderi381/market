@if (session('swal-error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'موفقیت',
                text: {{session('swal-error')}},
                confirmButtonText:'باشه'
            })
        })
    </script>
@endif
