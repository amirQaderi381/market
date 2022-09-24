@extends('customer.layouts.master-two-col')

@section('head-tag')
<title>انتخاب آدرس</title>
@endsection

@section('content')
<section>
    <!-- start cart -->
    <section class="mb-4">
       <section class="container-xxl" >
           <section class="row">
               <section class="col">
                   <!-- start vontent header -->
                   <section class="content-header">
                       <section class="d-flex justify-content-between align-items-center">
                           <h2 class="content-header-title">
                               <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                           </h2>
                           <section class="content-header-link">
                               <!--<a href="#">مشاهده همه</a>-->
                           </section>
                       </section>
                   </section>

                   <section class="row mt-4">

                    @if ($errors->any())
                     <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                     </ul>

                    @endif
                       <section class="col-md-9">
                           <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                               <!-- start vontent header -->
                               <section class="content-header mb-3">
                                   <section class="d-flex justify-content-between align-items-center">
                                       <h2 class="content-header-title content-header-title-small">
                                           انتخاب آدرس و مشخصات گیرنده
                                       </h2>
                                       <section class="content-header-link">
                                           <!--<a href="#">مشاهده همه</a>-->
                                       </section>
                                   </section>
                               </section>

                               <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                   <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                   <secrion>
                                       پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                   </secrion>
                               </section>


                               <section class="address-select">

                                @foreach(auth()->user()->addresses as $address)

                                   <input type="radio" form="myForm" name="address_id" value="{{ $address->id }}" id="{{ $address->id }}"/> <!--checked="checked"-->
                                   <label for="{{ $address->id }}" class="address-wrapper mb-2 p-2">
                                       <section class="mb-2">
                                           <i class="fa fa-map-marker-alt mx-1"></i>
                                           آدرس : {{ $address->address ?? '-' }}
                                       </section>
                                       <section class="mb-2">
                                           <i class="fa fa-user-tag mx-1"></i>
                                           گیرنده :  {{ $address->recipient_first_name ?? '-' }}   {{ $address->recipient_last_name ?? '-' }}
                                       </section>
                                       <section class="mb-2">
                                           <i class="fa fa-mobile-alt mx-1"></i>
                                           موبایل گیرنده :{{ $address->mobile }}
                                       </section>
                                       <a class="" data-bs-toggle="modal" data-bs-target="#edit-address-{{ $address->id }}"><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                       <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                   </label>

                                     <!-- start edit address Modal -->
                                     <section class="modal fade" id="edit-address-{{ $address->id }}" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ویرایش آدرس</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">
                                                    <form class="row" action="{{ route('customer.sales-process.update-address',$address->id) }}" method="post">
                                                     @csrf
                                                     @method('put')
                                                        <section class="col-6 mb-2">
                                                            <label for="province" class="form-label mb-1">استان</label>
                                                            <select name="province_id" class="form-select form-select-sm" id="province-{{ $address->id }}">
                                                                <option selected>استان را انتخاب کنید</option>
                                                                @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities',$province->id) }}" {{ $address->city->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="city" class="form-label mb-1">شهر</label>
                                                            <select name="city_id" class="form-select form-select-sm" id="city-{{ $address->id }}">
                                                                <option >شهر را انتخاب کنید</option>
                                                            </select>
                                                        </section>

                                                        <section class="col-12 mb-2">
                                                            <label for="address" class="form-label mb-1">نشانی</label>
                                                            <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی">{{ $address->address }}</textarea>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                            <input type="text" name="postal_code" value="{{ $address->postal_code }}" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="no" class="form-label mb-1">پلاک</label>
                                                            <input type="text" name="no" value="{{ $address->no }}" class="form-control form-control-sm" id="no" placeholder="پلاک">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="unit" class="form-label mb-1">واحد</label>
                                                            <input type="text" name="unit" value="{{ $address->unit }}" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                                        </section>

                                                        <section class="border-bottom mt-2 mb-3"></section>

                                                        <section class="col-12 mb-2">
                                                            <section class="form-check">
                                                                <input {{ $address->recipient_first_name ? 'checked' : '' }} class="form-check-input" type="checkbox" name="receiver"  id="receiver">
                                                                <label class="form-check-label" for="receiver">
                                                                    گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                                                </label>
                                                            </section>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="first_name" class="form-label mb-1">نام گیرنده</label>
                                                            <input type="text" name="recipient_first_name" value="{{ $address->recipient_first_name ? $address->recipient_first_name : ''  }}" class="form-control form-control-sm" id="first_name" placeholder="نام گیرنده">
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="last_name" class="form-label mb-1">نام خانوادگی گیرنده</label>
                                                            <input type="text" name="recipient_last_name" value="{{ $address->recipient_last_name ?? $address->recipient_last_name  }}" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                                        </section>

                                                        <section class="col mb-2">
                                                            <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                            <input type="text" name="mobile" value="{{ $address->mobile ?? $address->mobile  }}" class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                                        </section>

                                                        <section class="modal-footer py-1">
                                                         <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                         <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>

                                                     </section>
                                                    </form>
                                                </section>

                                            </section>
                                        </section>
                                    </section>
                                    <!-- end add address Modal -->

                                @endforeach

                                   <section class="address-add-wrapper">
                                       <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-address" ><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>

                                       <!-- start add address Modal -->
                                       <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                           <section class="modal-dialog">
                                               <section class="modal-content">
                                                   <section class="modal-header">
                                                       <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   </section>
                                                   <section class="modal-body">
                                                       <form class="row" action="{{ route('customer.sales-process.address') }}" method="post">
                                                        @csrf
                                                           <section class="col-6 mb-2">
                                                               <label for="province" class="form-label mb-1">استان</label>
                                                               <select name="province_id" class="form-select form-select-sm" id="province">
                                                                   <option selected>استان را انتخاب کنید</option>
                                                                   @foreach($provinces as $province)
                                                                   <option value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities',$province->id) }}">{{ $province->name }}</option>
                                                                   @endforeach

                                                               </select>
                                                           </section>

                                                           <section class="col-6 mb-2">
                                                               <label for="city" class="form-label mb-1">شهر</label>
                                                               <select name="city_id" class="form-select form-select-sm" id="city">
                                                                   <option selected>شهر را انتخاب کنید</option>
                                                               </select>
                                                           </section>

                                                           <section class="col-12 mb-2">
                                                               <label for="address" class="form-label mb-1">نشانی</label>
                                                               <textarea name="address" class="form-control form-control-sm" id="address" placeholder="نشانی"></textarea>
                                                           </section>

                                                           <section class="col-6 mb-2">
                                                               <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                               <input type="text" name="postal_code" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                                           </section>

                                                           <section class="col-3 mb-2">
                                                               <label for="no" class="form-label mb-1">پلاک</label>
                                                               <input type="text" name="no" class="form-control form-control-sm" id="no" placeholder="پلاک">
                                                           </section>

                                                           <section class="col-3 mb-2">
                                                               <label for="unit" class="form-label mb-1">واحد</label>
                                                               <input type="text" name="unit" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                                           </section>

                                                           <section class="border-bottom mt-2 mb-3"></section>

                                                           <section class="col-12 mb-2">
                                                               <section class="form-check">
                                                                   <input class="form-check-input" type="checkbox" name="receiver" id="receiver">
                                                                   <label class="form-check-label" for="receiver">
                                                                       گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                                                   </label>
                                                               </section>
                                                           </section>

                                                           <section class="col-6 mb-2">
                                                               <label for="first_name" class="form-label mb-1">نام گیرنده</label>
                                                               <input type="text" name="recipient_first_name" class="form-control form-control-sm" id="first_name" placeholder="نام گیرنده">
                                                           </section>

                                                           <section class="col-6 mb-2">
                                                               <label for="last_name" class="form-label mb-1">نام خانوادگی گیرنده</label>
                                                               <input type="text" name="recipient_last_name" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                                           </section>

                                                           <section class="col mb-2">
                                                               <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                               <input type="text" name="mobile" class="form-control form-control-sm" id="mobile" placeholder="شماره موبایل">
                                                           </section>

                                                           <section class="modal-footer py-1">
                                                            <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>

                                                        </section>
                                                       </form>
                                                   </section>

                                               </section>
                                           </section>
                                       </section>
                                       <!-- end add address Modal -->

                                   </section>

                               </section>
                           </section>


                           <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                               <!-- start vontent header -->
                               <section class="content-header mb-3">
                                   <section class="d-flex justify-content-between align-items-center">
                                       <h2 class="content-header-title content-header-title-small">
                                           انتخاب نحوه ارسال
                                       </h2>
                                       <section class="content-header-link">
                                           <!--<a href="#">مشاهده همه</a>-->
                                       </section>
                                   </section>
                               </section>
                               <section class="delivery-select ">

                                   <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                       <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                       <secrion>
                                           نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر بگیرید.
                                       </secrion>
                                   </section>

                                   @foreach($deliveryMethods as $deliveryMethod)

                                   <input type="radio" form="myForm" name="delivery_id" value="{{ $deliveryMethod->id }}" id="delivery-{{ $deliveryMethod->id }}" data-delivery-cost="{{$deliveryMethod->amount }}"/>
                                   <label for="delivery-{{ $deliveryMethod->id }}" class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                       <section class="mb-2">
                                           <i class="fa fa-shipping-fast mx-1"></i>
                                           {{ $deliveryMethod->name }}
                                       </section>
                                       <section class="mb-2">
                                           <i class="fa fa-calendar-alt mx-1"></i>
                                           تامین کالا از {{ $deliveryMethod->delivery_time }} {{ $deliveryMethod->delivery_time_unit }} کاری آینده
                                       </section>
                                   </label>

                                   @endforeach

                               </section>
                           </section>


                       </section>

                       <section class="col-md-3">
                          @php
                              $totalPrice = 0;
                              $totalDiscount=0;
                          @endphp

                          @foreach ($cartItems as $cartItem)
                                @php
                                     $totalPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                                     $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number
                                @endphp
                          @endforeach
                           <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                               <section class="d-flex justify-content-between align-items-center">
                                   <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                   <p class="text-muted">{{ priceFormat($totalPrice) }} تومان</p>
                               </section>

                               <section class="d-flex justify-content-between align-items-center">
                                   <p class="text-muted">تخفیف کالاها</p>
                                   <p class="text-danger fw-bolder">{{ priceFormat($totalDiscount) }} تومان</p>
                               </section>

                               <section class="border-bottom mb-3"></section>

                               <section class="d-flex justify-content-between align-items-center">
                                   <p class="text-muted">جمع سبد خرید</p>
                                   <p class="fw-bolder">{{ priceFormat($totalPrice - $totalDiscount) }} تومان</p>
                               </section>

                               <section class="d-flex justify-content-between align-items-center">
                                   <p class="text-muted">هزینه ارسال</p>
                                   <p class="text-warning"><span id="selected-delivery-cost">۰</span> تومان</p>
                               </section>

                               <p class="my-3">
                                   <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                               </p>

                               <section class="border-bottom mb-3"></section>

                               <section class="d-flex justify-content-between align-items-center">
                                   <p class="text-muted">مبلغ قابل پرداخت</p>
                                   <p class="fw-bold"><span id="paymentable-price" data-paymentable-price="{{ $totalPrice - $totalDiscount }}">{{ priceFormat($totalPrice - $totalDiscount) }}</span> تومان</p>
                               </section>

                               <form action="{{ route('customer.sales-process.choose-address-and-delivery') }}" method="post" id="myForm">
                                  @csrf
                              </form>

                               <section class="">
                                   <section id="address-button" href="address.html" class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">آدرس و نحوه ارسال را انتخاب کن</section>
                                   <button id="next-level" href="payment.html" class="btn btn-danger d-none" onclick="document.getElementById('myForm').submit()">ادامه فرآیند خرید</button>
                               </section>

                           </section>
                       </section>
                   </section>
               </section>
           </section>

       </section>
   </section>
   <!-- end cart -->
</section>

@endsection

@section('script')
<script>

    $('#province').change(function(){

        let element = $('#province option:selected');
        let url = element.data('url');


        $.ajax({

            type:'GET',
            url:url,
            success:function(response){

                let cities = response.cities;

                $('#city').empty();

                cities.map((city)=>{
                  $('#city').append($('<option/>').val(city.id).text(city.name))
                })
            },
            error:function()
            {
                console.log('error')
            }
        })
    })




    // edit address

    let addresses = {!! auth()->user()->addresses !!};

    // map behave like php foreach

    addresses.map((address)=>{

        let target = `#province-${address.id}`;
        let selected = `${target} option:selected`;

        ajaxRequest();


        $(target).change(function(){

             ajaxRequest();

        });

        function ajaxRequest()
        {
            let element = $(selected);
            let url = element.data('url');

            $.ajax({

               type:'GET',
               url:url,
               success:function(response){

                   let cities = response.cities;

                   $(`#city-${address.id}`).empty();

                   cities.map((city)=>{
                      $(`#city-${address.id}`).append($('<option city == {!! $address->city_id  ? "selected" : "" !!}></option>').val(city.id).text(city.name))
                   })
                },
                error:function()
                {
                   console.log('error')
                }
           })
        }

    });


</script>

<script>
    $(document).ready(function(){

        let delivery_price = 0;


        $('input[type=radio][name=address_id]').click(function() {

            let address = $('input[type=radio][name=address_id]').is(':checked');
            let delivery = $('input[type=radio][name=delivery_id]').is(':checked');

            if(address == true && delivery == true)
            {
                //chnage button after selected address and delivery method
                $("#address-button").removeClass("d-block");
                $("#address-button").addClass("d-none");
                $("#next-level").removeClass("d-none");
                $("#next-level").addClass("d-block w-100");

            }

        });

        $('input[type=radio][name=delivery_id]').click(function() {


            // show final-price
            delivery_cost =parseFloat( $(this).data('delivery-cost'));
            console.log(delivery_cost)
            $('#selected-delivery-cost').html(toPersianNumber(delivery_cost));
            let paymentable_price = parseFloat($('#paymentable-price').data('paymentable-price'));
            $('#paymentable-price').html( toPersianNumber(paymentable_price += delivery_cost));


            let address = $('input[type=radio][name=address_id]').is(':checked');
            let delivery = $('input[type=radio][name=delivery_id]').is(':checked');


            if(address == true && delivery == true)
            {
                //chnage button after selected address and delivery method
                $("#address-button").removeClass("d-block");
                $("#address-button").addClass("d-none");
                $("#next-level").removeClass("d-none");
                $("#next-level").addClass("d-block w-100");

            }


        });

        function toPersianNumber(number)
        {
            const persianDigits= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];

            //add comma
             number = new Intl.NumberFormat().format(number);

            //convert to persian
            return number.toString().replace(/\d/g, x => persianDigits[x]);
        }

    })

</script>

@endsection
