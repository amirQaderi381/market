@extends('customer.layouts.master-two-col')


@section('head-tag')
<title>آدرس های شما</title>
@endsection


@section('content')

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
                                <span>آدرس های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <section class="address-select">

                        @forelse(auth()->user()->addresses as $address)

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
                            <!-- end edit address Modal -->

                            @empty

                            <p>آدرسی باری این کاربر وجود ندارد</p>

                        @endforelse

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
            </main>
        </section>
    </section>
</section>
<!-- end body -->

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
@endsection
