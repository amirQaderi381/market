@if (session('toast-success'))


<section class="toast-wrapper position-fixed p-4 flex-row-reverse" style="z-index: 909999999;left: 0; top: 3rem; width: 26rem; max-width: 80%;">
    <section class="toast" data-delay="5000">
        <section class="toast-body py-3 d-flex bg-success text-white">
           <strong class="ml-auto">{{session('toast-success')}}</strong>
           {{-- <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button> --}}
        </section>
     </section>
</section>



  <script>
    $(document).ready(function(){
        $('.toast').toast('show')
    })
  </script>

@endif
