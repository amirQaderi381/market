@if (session('toast-error'))

<section class="position-fixed p-4 flex-row-reverse" style="z-index: 909999999; left: 0; top: 3rem; width: 26rem; max-width: 80%;">
    <div class="toast bg-danger" id="toast" data-delay="7000" role="alert" aria-live="assertive" aria-atomic="true">

        <div class="d-flex  flex-row-reverse ">
            <div class="toast-header bg-danger ">

                <button type="button" class="btn-close " data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

            <div class="toast-body" style="margin-left: auto !important">
                <strong class="text-white">

                   {{ session('toast-error') }}

                </strong>
            </div>
        </div>
      </div>
</section>

  <script>
    $(document).ready(function(){
        $('.toast').toast('show')
    })
  </script>

@endif
