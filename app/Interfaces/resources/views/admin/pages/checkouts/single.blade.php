@extends('admin.layouts.master')
@section('title')
    تفاصيل الطلب
@endsection
@section('content')
    @php
        $location = parse_location($checkout->location);
    @endphp

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <style>
        #map { height: 500px; width: 100% }
    </style>

    <div class="content">
        <div class="col-sm-12 page-heading">
            <div class="col-sm-6">
                <h2>تفاصيل الطلب</h2>
            </div><!--End col-md-6-->
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">لوحة التحكم</a></li>
                    <li class="active">تفاصيل الطلب</li>
                </ul>
            </div><!--End col-md-6-->
        </div>
        <div class="spacer-15"></div>
        <div class="widget">
            <div class="widget-content">
                <div class="col-md-12 form-group">
                    <a href="{{ url('admin/checkouts/order/invoice/' . $checkout->id) }}" style="background: #a3002e !important;" class="btn btn-danger">عرض الفاتورة</a>
                    <a href="{{ url('admin/checkouts/order/invoice/download/' . $checkout->id) }}" style="background: #000 !important;" class="btn btn-danger">تحميل الفاتورة</a>
                </div>
                <div class="col-md-6 form-group">
                    <label>الاسم</label>
                    <blockquote>{{$checkout->name}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>المدينه</label>
                    <blockquote>{{$checkout->city}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>رقم الجوال</label>
                    <blockquote>{{$checkout->phone}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>البريد الالكتروني</label>
                    <blockquote>{{$checkout->email}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>العنوان</label>
                    <blockquote>{{$checkout->address}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>طريقه الاستلام</label>
                    <blockquote>{{$checkout->receive}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>طريقه الدفع</label>
                    <blockquote>{{$checkout->payment}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>الضريبة</label>
                    <blockquote>{{$checkout->tax}}</blockquote>
                </div>
                <div class="col-md-6 form-group">
                    <label>اجمالي المبلغ المطلوب</label>
                    <blockquote>{{$checkout->price}}</blockquote>
                </div>
            </div>
        </div>
        <div class="spacer-15"></div>
        <div class="widget">
            <div class="widget-content">
                <div class="spacer-15"></div>
                <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr >
                    <th class="text-center">#</th>
                    <th class="text-center">اسم المنتج</th>
                    <th class="text-center">الكمبه</th>
                    <th class="text-center">السعر</th>
                    <th class="text-center">الحجم المطلوب</th>
                    <th class="text-center">نوع الذبج</th>
                    <th class="text-center">طريقه التقطيع</th>
                    <th class="text-center">التغليف</th>
                    <th class="text-center">الراس</th>
                    <th class="text-center">مفروم</th>
                    <th class="text-center">عدد الكيلوات</th>
                    <th class="text-center">الملاحظات</th>
                    <th class="text-center">اجمالي السعر</th>
                </tr>
                </thead>
                <tbody>
                @foreach($checkout->orders as $index => $order)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->qty}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->kind}}</td>
                        <td>{{$order->type}}</td>
                        <td>{{$order->cutting}}</td>
                        <td>{{$order->packing}}</td>
                        <td>{{$order->head}}</td>
                        <td>{{$order->minced}}</td>
                        <td>{{$order->weight}}</td>
                        <td>{{$order->comments}}</td>
                        <td>{{$order->total}}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>
                    @if(!empty($location['Lat']) AND !empty($location['Lng']))

                    <table class="table table-bordered table-hover text-center">

                        <tr>
                            <div id="map"></div>


                        </tr>
                    </table>
@endif
        </div>
            </div>
        </div>



        <div class="widget">
            <div class="widget-content">
                <h4 class="h4"> حالات الطلب</h4>
                <div class="spacer-15"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr >
                            <th class="text-center">#</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">التعليق</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($checkout->histories as $index => $history)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{$history->status}}</td>
                                <td>{{$history->comment}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="widget">
        <h4 class="h4">اضافة حالة للطلب</h4>

        <form class="widget-content ajax-form" action="{{route('admin.checkouts.order.history',$checkout->id)}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="col-md-12">

                <select class="form-control" name="status">
                    @foreach($orderStatus as $status)
                        <option value="{{ $status->name }}">{{ $status->name }}</option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label>التعليق</label>
                    <textarea class="form-control" name="comment" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-sm-12 save-btn">
                <button class="custom-btn green-bc" type="submit">حفظ</button>
            </div>
        </form>
    </div>


    @if(!empty($location['Lat']) AND !empty($location['Lng']))



    <script>

        var mymap = L.map('map', {
            center: [24.487149, -313.198242],
            zoom: 18
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibW9oYW1lZGFobWVkMDAiLCJhIjoiY2tnbXN3ZGcxMG9jYjJxbzE2Mjl4aHZidyJ9.4l4Ypb2qRyuNOyHrdmWUcw', {
            id: 'mapbox/streets-v11',
            accessToken: 'pk.eyJ1IjoibW9oYW1lZGFobWVkMDAiLCJhIjoiY2tnbXN3ZGcxMG9jYjJxbzE2Mjl4aHZidyJ9.4l4Ypb2qRyuNOyHrdmWUcw'
        }).addTo(mymap);

        var marker = L.marker([24.487149, -313.198242]).addTo(mymap);

    </script>
    @endif

@endsection
