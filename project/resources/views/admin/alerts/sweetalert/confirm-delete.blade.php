<script>
    $(document).ready(function() {

        const className = '{{$className}}';
        let element = $('.' + className);

        element.on('click', function(e) {

            e.preventDefault();

            let swalWithBootstrap = swal.mixin({

                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },

                buttonsStyling : false,
            })



            swalWithBootstrap.fire({
                title: 'آیا از حذف داده مطمعن هستید‌؟',
                text: 'شما میتوانید درخواست خود را لغو نمایید',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله داده حذف شود!',
                cancelButtonText: 'خیر درخواست لغو شود!',
                reverseButtons: true
            }).then((result) => {

                if (result.value == true) {
                    $(this).parent().submit();

                } else if (result.dismiss == Swal.DismissReason.cancel) {
                    swalWithBootstrap.fire({

                        title: 'لغو درخواست',
                        text: 'درخواست شما لغو شد',
                        icon: 'error',
                        confirmButtonText: 'یاشه'
                    })
                }
            })

        });

    });
</script>
