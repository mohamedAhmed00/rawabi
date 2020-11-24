@extends('site.layouts.master')
@section('title')
    الدفع
@endsection
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <style>
        #map { height: 500px; width: 100% }
        #location-pick{
            direction: ltr !important;
        }
    </style>

    <section class="page-head">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{route('site.index')}}">الرئيسية</a>
                </li>
                <li class="active">الدفع</li>
            </ul>
            <h4>الدفع</h4>
        </div><!--End Container-->
    </section>
    <div class="page-content">
        <section class="section checkout">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="steps-box">
                            <div id="form_wizard_1">
                                <form class="" method="post" action="{{route('site.checkout')}}" id="submit_form" name="form-wizard">
                                    {!! csrf_field() !!}
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" id="Step1" data-toggle="tab" class="step active">
                                                    تفاصيل الطلب
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" id="Step2" data-toggle="tab" class="step" aria-expanded="true">
                                                    طريقة التواصل
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" id="Step3" data-toggle="tab" class="step">
                                                    طريقة الدفع
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" id="Step4" data-toggle="tab" class="step">
                                                    ملخص الطلب
                                                </a>
                                            </li>
                                        </ul><!--End Nav-->

                                        <div class="tab-content">
                                            <div class="alerts">
                                                <div class="alert alert-danger" hidden>
                                                    <button class="close" data-dismiss="alert"></button> You have some 	form errors. Please check below.
                                                </div><!--End alert-->
                                                <div class="alert alert-success" hidden>
                                                    <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                                                </div><!--End alert-->
                                            </div><!--End Alerts-->
                                            <div class="tab-pane active" id="tab1">
                                                <div class="inner-tap">
                                                    <div class="Inner-Tap-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>الاسم</label>
                                                                    <input type="text" name="name" id="memberName" placeholder="اكتب الاسم كاملا" class="form-control">
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>المدينة</label>
                                                                    <select class="form-control" name="city" id="cityName">
                                                                        <option value="0">اختر مدينتك</option>
                                                                        @foreach($cities as $city)
                                                                            <option value="{{$city->name}}">{{$city->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>رقم الجوال</label>
                                                                    <input type="text" name="phone" id="PhoneNumber" placeholder="ادخل رقم الجوال" class="form-control">
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>البريد الالكتروني</label>
                                                                    <input type="email" name="email" id="email" placeholder="ادخل البريد الالكتروني" class="form-control">
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>العنوان</label>
                                                                    <input type="text" name="address" id="AddressInput" placeholder="ادخل العنوان كاملا" class="form-control">
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>اختيار المكان</label>
                                                                    <input type="text" name="location" id="geoloc" placeholder="أختيار العنوان من علي الخريطة" class="form-control">
                                                                </div><!--End form-group-->
                                                            </div><!--End col-md-6-->

                                                        </div><!--End row-->

                                                    </div><!-- End Inner-Tap-Body -->
                                                </div><!-- End Inner-Tab -->
                                                <div class="form-action">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="inner-tap">
                                                                <a href="javascript:;" class="step-btn button-next" onclick="second_step();"> التالى
                                                                </a>
                                                            </div><!--End inner-tap-->
                                                        </div>
                                                    </div><!--End Row-->
                                                </div><!--End Form-action-->
                                            </div><!--End Tab-pane-->
                                            <div class="tab-pane" id="tab2">
                                                <div class="inner-tap">
                                                    <div class="Inner-Tap-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-3">
                                                                    <div class="radio-check-item radius-item">
                                                                        <input name="receive" value="واتس اب" class="form-control" id="whats" type="radio">
                                                                        <label for="whats">واتس اب</label>
                                                                    </div><!-- End Radio-Check-Item -->
                                                                    <div class="radio-check-item radius-item">
                                                                        <input name="receive" value="اتصال" class="form-control" id="call" type="radio">
                                                                        <label for="call">اتصال</label>
                                                                    </div><!-- End Radio-Check-Item -->
                                                                </div>
                                                            </div><!--End col-->
                                                        </div><!--End row-->
                                                    </div><!-- End Inner-Tap-Body -->
                                                </div><!-- End Inner-Tab -->
                                                <div class="form-action">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="inner-tap">
                                                                <a href="javascript:;" class="step-btn button-previous" onclick="first_step();"> السابق </a>
                                                                <a href="javascript:;" class="step-btn button-next" onclick="third_step();"> التالى</a>
                                                            </div><!--End inner-tap-->
                                                        </div>
                                                    </div><!--End Row-->
                                                </div><!--End Form-action-->
                                            </div><!--End Tab-pane-->
                                            <div class="tab-pane" id="tab3">
                                                <div class="inner-tap">
                                                    <div class="Inner-Tap-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label>طريقة الدفع</label>
                                                                <div class="radio-check-item radius-item">
                                                                    <input name="payment" value="الدفع نقدا عند الاستلام" class="form-control" id="cash" type="radio">
                                                                    <label for="cash">الدفع نقدا عند الاستلام</label>
                                                                </div><!-- End Radio-Check-Item -->
                                                                <div class="radio-check-item radius-item">
                                                                    <input name="payment" value="الدفع ببطاقة مدى عند الاستلام" class="form-control" id="mada" type="radio">
                                                                    <label for="mada"> الدفع ببطاقة مدى عند الاستلام</label>
                                                                </div><!-- End Radio-Check-Item -->
                                                            </div><!--End form-group-->
                                                        </div><!--End row-->
                                                    </div><!-- End Inner-Tap-Body -->
                                                </div><!-- End Inner-Tab -->
                                                <div class="form-action">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="inner-tap">
                                                                <a href="javascript:;" class="step-btn button-previous" onclick="second_step();"> السابق </a>
                                                                <a href="javascript:;" class="step-btn button-next" onclick="fourth_step();"> التالى</a>
                                                            </div><!--End inner-tap-->
                                                        </div>
                                                    </div><!--End Row-->
                                                </div><!--End Form-action-->
                                            </div><!--End Tab-pane-->
                                            <div class="tab-pane" id="tab4">
                                                <div class="inner-tap">
                                                    <div class="Inner-Tap-body">
                                                        <table class="table-cart">
                                                            <thead>
                                                            <tr>
                                                                <th class="product-thumbnail">المنتج</th>
                                                                <th class="product-name">النوع</th>
                                                                <th class="product-price">السعر</th>
                                                                <th class="product-quantity">الكمية</th>
                                                                <th class="product-subtotal">الاجمالى</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($products as $product)
                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <a href="">
                                                                        <img src="{{Storage::url($product->options['image'])}}">
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="{{route('site.orders.single', \Illuminate\Support\Str::slug($product->name))}}">{{$product->name}} </a>
                                                                </td>

                                                                <td class="product-price">
                                                                    {{$product->price}} ر.س
                                                                </td>
                                                                <td class="product-quantity">
                                                                    {{$product->qty}}
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    {{$product->price * $product->qty}} ر.س
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td class="total-price" colspan="3">
                                                                    الاجمالى
                                                                </td>

                                                                <td class="product-price" colspan="2">
                                                                    {{\Cart::subtotal()}} ر.س
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="total-price" colspan="3">
                                                                    الضريبة
                                                                </td>

                                                                <td class="product-price" colspan="2">
                                                                    {{\Cart::tax()}} ر.س
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="total-price" colspan="3">
                                                                    الاجمالي النهائي
                                                                </td>

                                                                <td class="product-price" colspan="2">
                                                                    {{\Cart::total()}} ر.س
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div><!-- End Inner-Tap-Body -->
                                                </div><!-- End Inner-Tab -->
                                                <div class="form-action">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="inner-tap">
                                                                <a href="javascript:;" class="step-btn button-previous" onclick="third_step();"> السابق </a>
                                                                <a href="javascript:;" class="step-btn button-submit"> حفظ
                                                                    <i class="fa fa-check"></i>
                                                                </a>
                                                            </div><!--End inner-tap-->
                                                        </div>
                                                    </div><!--End Row-->
                                                </div><!--End Form-action-->
                                            </div><!--End Tab-pane-->
                                        </div><!--End Tap-content-->
                                    </div><!--End Form-body-->
                                </form><!--End Form-->
                            </div><!--End Div Of Form-wizard-->
                        </div><!--End Steps-box-->

                    </div><!--End col-->
                </div><!--End row-->
            </div><!-- End container -->
        </section><!-- End Section -->
        <br><br><br><br>
    </div><!--End page-content-->


    <div class="modal fade mt-5" style="direction: rtl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-2">
                <div class="modal-header border-danger p-2">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">خطاء في تجاوز عدد المحاولات</h5>

                </div>
                <div class="modal-body text-danger">
                    <p class="lead p-2">
                        تم تجاوز الحد الادني للمحاولات وتم حظرك من الطلبات للعودة مجددا برجاء التواصل ادارة الموقع
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade mt-5" id="location-pick" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content p-2">
                <div class="modal-header border-danger p-2">
                    <h5 class="modal-title text-danger">  اختار المكان علي الخريطة</h5>

                </div>
                <div class="modal-body text-danger">



                    <div id="map"></div>

                </div>

            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        var form = $('#submit_form');
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);

        function first_step(){
            $('#Step1').trigger('click');
        }

        function second_step(){
            if (validate_step_one()){
                $('#Step2').trigger('click');
            }
        }

        function third_step(){
            if (validate_step_two()) {
                $('#Step3').trigger('click');
            }
        }

        function fourth_step(){
            if (validate_step_three()) {
                $('#Step4').trigger('click');
            }
        }

        function validate_step_one() {
            if ($('#memberName').val() == '' || $('#memberName').val() == null){
                swal({
                    title: "برجاء ادخال اسمك بالكامل",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            if ($('#cityName').val() == '0' ){
                swal({
                    title: "برجاء اختيار مدينتك",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            if ($('#PhoneNumber').val() == '' || $('#PhoneNumber').val() == null){
                swal({
                    title: "برجاء ادخال رقم الهاتف الخاص بك",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            if ($('#AddressInput').val() == '' || $('#AddressInput').val() == null){
                swal({
                    title: "برجاء ادخال العنوان بالكامل",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            return true;
        }

        function validate_step_two() {
            if (!$("input[name='receive']").is(':checked')){
                swal({
                    title: "برجاء اختيار طريقه الطلب",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            return true;
        }

        function validate_step_three() {
            if (!$("input[name='payment']").is(':checked')){
                swal({
                    title: "برجاء اختيار طريقه الدفع",
                    type: "error",
                    confirmButtonClass: "swal-confirm",
                    confirmButtonText: "اغلاق!",
                    titleClass:"swal-text",
                    closeOnConfirm: true,
                    allowOutsideClick: true
                });

                return false;
            }

            return true;
        }

        $('.button-submit').on('click' ,function () {
            var form = $(this).closest('form');
            var url = form.attr('action');

            $.ajax({
                url : url,
                dataType: 'json',
                method: 'POST',
                data : form.serialize(),
                success : function (response) {
                    if (response.status === 'success'){
                        swal({
                            title: response.title,
                            type: "success",
                            confirmButtonClass: "swal-confirm",
                            confirmButtonText: "اغلاق!",
                            titleClass:"swal-text",
                            closeOnConfirm: true,
                            allowOutsideClick: true
                        }, function () {
                            location.replace(response.url);
                        });

                    }else{
                        swal({
                            title: response.title,
                            type: "error",
                            confirmButtonClass: "swal-confirm",
                            confirmButtonText: "اغلاق!",
                            titleClass:"swal-text",
                            closeOnConfirm: true,
                            allowOutsideClick: true
                        });
                    }
                },
                error : function (response) {
                    if(response.status == 429){
                        $('#exampleModal').modal('toggle')
                    }
                }
            })
        })


        $("#geoloc").click(function (){
            $("#location-pick").modal('show');
        });

        $('#confirmPosition').click(function (){
            $("#location-pick").modal('hide');
        })


    </script>

    <script>
        $(document).ready(function (){
            var mymap = L.map('map', {
                center: [24.487149, -313.198242],
                zoom: 18
            });

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibW9oYW1lZGFobWVkMDAiLCJhIjoiY2tnbXN3ZGcxMG9jYjJxbzE2Mjl4aHZidyJ9.4l4Ypb2qRyuNOyHrdmWUcw', {
                id: 'mapbox/streets-v11',
                accessToken: 'pk.eyJ1IjoibW9oYW1lZGFobWVkMDAiLCJhIjoiY2tnbXN3ZGcxMG9jYjJxbzE2Mjl4aHZidyJ9.4l4Ypb2qRyuNOyHrdmWUcw'
            }).addTo(mymap);

            L.marker([24.487149, -313.198242]).addTo(mymap);

            function onMapClick(e) {
                $("#geoloc").val(`${e.latlng.lat},${e.latlng.lng}`);
                $("#location-pick").modal('hide');
            }

            mymap.on('click', onMapClick);

        });




    </script>





@endsection
