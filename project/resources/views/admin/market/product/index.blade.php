@extends('admin.layouts.master')

@section('head-tag')
    <title>کالاها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالاها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        کالاها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد کالای جدید </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام کالا</th>
                                <th scope="col"> تصویر کالا</th>
                                <th scope="col"> قیمت</th>
                                <th scope="col">دسته </th>
                                <th scope="col">وضعیت محصول</th>
                                <th scope="col">وضعیت قابل فروش</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}" alt=""
                                        class="max-height-2rem" width="100" height="50">
                                </td>
                                <td>{{ $product->price }} تومان</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <label>
                                        <input id="product-{{ $product->id }}"
                                            onchange="changeStatus({{ $product->id }})"
                                            data-url="{{ route('admin.market.product.status', $product->id) }}"
                                            type="checkbox" @if ($product->status === 1) checked @endif>
                                    </label>
                                </td>

                                <td>
                                    <label>
                                        <input id="{{ $product->id }}"
                                            onchange="changeMarketable({{ $product->id }})"
                                            data-url="{{ route('admin.market.product.marketable', $product->id) }}"
                                            type="checkbox" @if ($product->marketable === 1) checked @endif>
                                    </label>
                                </td>

                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dorpdown-toggle" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i> عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="{{ route('admin.market.gallery.index',$product->id) }}" class="dropdown-item text-right">
                                                <i class="fa fa-images"></i> گالری
                                            </a>

                                            <a href="{{ route('admin.market.guarantee.index',$product->id) }}" class="dropdown-item text-right">
                                                <i class="fa fa-shield-alt"></i> گارانتی
                                            </a>

                                            <a href="{{ route('admin.market.color.index',$product->id) }}" class="dropdown-item text-right">
                                                <i class="fa fa-list-ul"></i> رنگ کالا
                                            </a>

                                            <a href="{{ route('admin.market.product.edit',$product->id) }}" class="dropdown-item text-right">
                                                <i class="fa fa-edit"></i> ویرایش
                                            </a>

                                            <form action="{{ route('admin.market.product.destroy',$product->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item text-right delete">
                                                    <i class="fa fa-window-close"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>
@endsection

@section('script')

    <script type="text/javascript">

        function changeStatus(id) {
            let element = $('#product-' + id);
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('وضعیت با موفقیت فعال شد')

                        } else {
                            element.prop('checked', false);
                            successToast('وضعیت با موفقیت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد');
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            };

            function errorToast(message) {
                let errorToastTags = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(errorToastTags);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                });
            }

        }

        function changeMarketable(id) {
            let element = $('#' + id);
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked'); // return ture/false

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.marketable) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('وضعیت قابل فروش با موفقیت فعال شد')

                        } else {
                            element.prop('checked', false);
                            successToast('وضعیت قابل فروش با موفقیت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است');
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد');
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            };

            function errorToast(message) {
                let errorToastTags = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    ' </button>\n' +
                    '</section>\n' +
                    '</section>\n';

                $('.toast-wrapper').append(errorToastTags);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                });
            }

        }
    </script>

    @include('admin.alerts.sweetalert.confirm-delete', ['className' => 'delete'])

@endsection

