@extends('admin.layouts.master-invoce')
@section('title')
    الفاتورة
@endsection
@section('content')
    <div class="invoice-wrap">
        <div class="invoice-head">
            <div class="invoice-logo">
                <img src="{{asset('assets/admin/images/logo.png')}}">
            </div><!--End invoice-logo-->
            <div class="invoice-info">
                <p>روابى القصيم</p>
                <p>الرقم الضريبي :{{ optional($settings)['tax_number'] }}</p>
                <p>رقم الجوال : {{ $checkout->phone }}</p>
                <p>{{ $checkout->email }}</p>
            </div><!--End invoice-info-->
        </div><!--End invoice-head-->
        <table class="table table-bordered invoice-info">
            <thead>
            <tr>
                <td colspan="2">
                    <b>تاريخ الطلب: {{ date( 'd / m / Y' , strtotime($checkout->created_at)) }}</b>
                    <b> رقم الطلب : {{ $checkout->id }}</b>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <address>
                        <b>اسم العميل</b>
                        {{ $checkout->name }}
                        <br>
                        <b>المدينة:</b>
                        {{ $checkout->city }}
                        <br>
                        <b>العنوان</b>
                        {{ $checkout->address }}
                        <br>
                    </address>
                </td>
                <td>
                    <b>طريقة الدفع:</b>
                    {{ $checkout->payment }}
                    <br>
                    <b>
                        رقم الجوال:</b>
                    {{ $checkout->phone }}
                    <br>
                    <b>طريقة تأكيد الطلب:</b>
                    {{ $checkout->receive }}
                    <br>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered invoice-ord">
            <thead>
            <tr>
                <td><b>الطلبات</b></td>
                <td><b>الكمية</b></td>
                <td><b>سعر الوحدة</b></td>
                <td><b>الاجمالي</b></td>
            </tr>
            </thead>
            <tbody>
            @foreach($checkout->orders as $order)
                <tr>
                    <td>
                        {{ $order->name }}
                        @isset($order->kind)
                            <small> - الحجم المطلوب: {{ $order->kind }}</small>
                        @endif

                        @isset($order->type)
                            <small> - النوع: {{ $order->type }}</small>
                        @endif

                        @isset($order->cutting)
                            <small> - طريقة التقطيع: {{ $order->cutting }}</small>
                        @endif

                        @isset($order->packing)
                            <small> - نوع التغليف: {{ $order->packing }} </small>
                        @endif

                        @isset($order->head)
                            <small> - الراس : {{ $order->head }}</small>
                        @endif

                        @isset($order->minced)
                            <small> - مفروم: {{ $order->minced }}</small>
                        @endif

                        @isset($order->weight)
                            <small> - الوزن: {{ $order->weight }}</small>
                        @endif

                        @isset($order->comments)
                            <small> - ملاحظات الطلب: {{ $order->comments }}</small>
                        @endif
                    </td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ $order->price }} ر.س </td>
                    <td>{{ $order->total }} ر.س </td>
                </tr>

            @endforeach
            <tr>
                <td colspan="3"><b>الضريبة</b></td>
                <td>{{ $checkout->tax }} ر.س </td>
            </tr>
            <tr>
                <td colspan="3"><b>الاجمالي النهائي</b></td>
                <td>{{ $checkout->price }} ر.س </td>
            </tr>
            </tbody>
        </table>
    </div><!--End invoice-wrap-->


@endsection
