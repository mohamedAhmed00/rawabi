<!DOCTYPE html>
<html>
<head>
    <title>روابي</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
{{--    <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">--}}
    <style>
        .wrapper
        {
            width: 850px;
            height: 1000px;
            margin: auto;
            background-color: #FFF;
            background-size:100% 100%;
            padding-top: 45px;
        }

        body{
            background: #FFF !important;
        }
        *, *:focus {
            outline: none!important;
        }
        body {
            direction: rtl;
            text-align: right;
            background: #E7E9ED;
        }

        p {
            margin: 0;
        }
        .invoice-wrap {
            margin: 15px auto;
            padding: 70px;
            max-width: 850px;
            background-color: #fff;
            border: 1px solid #ccc;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            font-family: 'Droid Arabic Kufi', sans-serif;
            line-height: 22px;
            font-size: 14px;
        }

        .invoice-head {
            overflow: hidden;
            margin-bottom: 20px;
        }
        .invoice-head .invoice-logo {
            float: right;
        }
        .invoice-head .invoice-logo img {
            height: 100px;
        }
        .invoice-head .invoice-info {
            float: left;
            margin-left: 5px;
            margin-top: 10px;
        }
        .invoice-head .invoice-info p {
            line-height: 25px;
            font-size: 15px;
        }
        .invoice-head .invoice-info p:nth-child(1) {
            margin-bottom: 3px;
        }
        .invoice-wrap table {

            border: 1px solid #f5f5f5;
        }

        .invoice-wrap .table{
            position: relative;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0 0 20px;
            border: 1px solid #ddd;
        }
        .invoice-wrap .table td {
            min-width: 110px;
        }
        .invoice-wrap .table  tbody  tr  td:nth-child(1),
        .invoice-wrap .table  tbody  tr  td:nth-child(3) {
            background: #fafafa;
        }
        .invoice-ord  tbody  tr  td:nth-child(2),
        .invoice-ord  tbody  tr  td:nth-child(3),
        .invoice-ord  tbody  tr  td:nth-child(4){
            font-weight: bold;
        }
        .invoice-wrap .table  tbody  tr  td{
            padding: 12px 15px 12px 10px;
            text-align: right;
            vertical-align: middle;
            background-color: #fdfdfd;
            border: none;
            border-bottom: 1px solid #ddd;
            color: #5e5b54;
            line-height: 30px;
        }
        .invoice-wrap .invoice-info tbody tr td {
            width: 50%;
        }
        .invoice-wrap .invoice-ord tbody  tr  td:nth-child(1) {
            font-size: 15px;
            line-height: 33px;
        }
        .invoice-ord tbody  tr  td span{
            display: block;
            padding-right: 10px;
            font-size: 13px;
            line-height: 33px;
        }

        .invoice-head .invoice-logo {
            float: right;
            width: 60%;
        }

        .invoice-head .invoice-logo img{
            height: 100px !important;
        }

        .invoice-head .invoice-info {
            float: right;
            width: 40%;
            text-align: right;
        }

        .invoice-head .invoice-info p {
            margin-bottom: 7px;
        }
        .table{
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0 0 20px;
            border: 1px solid #ddd;
        }
        .table-bordered thead tr th,
        .table-bordered thead tr td {
            border-bottom-width: 2px;
        }
        .table thead tr th,
        .table tbody tr th,
        .table tfoot tr th,
        .table thead tr td,
        .table tbody tr td,
        .table tfoot tr td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
        }

        .table-bordered thead tr th,
        .table-bordered tbody tr th,
        .table-bordered tfoot tr th,
        .table-bordered thead tr td,
        .table-bordered tbody tr td,
        .table-bordered tfoot tr td {
            border: 1px solid #ddd;
        }

        .invoice-wrap .table tbody tr td:nth-child(1),
        .invoice-wrap .table tbody tr td:nth-child(3) {
            background: #fafafa;
        }
    </style>
</head>
<body dir="rtl" style="background: #FFF">
<div class="invoice-wrap wrapper">
    <div class="invoice-head">
        <div class="invoice-logo">
            <img style="height: 100px" src="var:logo">
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
            <td>
                <b>تاريخ الطلب: {{ date( 'd / m / Y' , strtotime($checkout->created_at)) }}</b>
            </td>
            <td>
                <b> رقم الطلب : {{ $checkout->id }}</b>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                    <b>اسم العميل</b>
                    {{ $checkout->name }}
                    <br>
                    <b>المدينة:</b>
                    {{ $checkout->city }}
                    <br>
                    <b>العنوان</b>
                    {{ $checkout->address }}
                    <br>
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
                        <span> - الحجم المطلوب: {{ $order->kind }}</span>
                        <br>
                    @endif

                    @isset($order->type)
                        <span> - النوع: {{ $order->type }}</span>
                        <br>

                    @endif

                    @isset($order->cutting)
                        <span> - طريقة التقطيع: {{ $order->cutting }}</span>
                        <br>

                    @endif

                    @isset($order->packing)
                        <span> - نوع التغليف: {{ $order->packing }} </span>
                        <br>

                    @endif

                    @isset($order->head)
                        <span> - الراس : {{ $order->head }}</span>
                    @endif

                    @isset($order->minced)
                        <span> - مفروم: {{ $order->minced }}</span>
                        <br>

                    @endif

                    @isset($order->weight)
                        <span> - الوزن: {{ $order->weight }}</span>
                        <br>

                    @endif

                    @isset($order->comments)
                        <span> - ملاحظات الطلب: {{ $order->comments }}</span>
                        <br>

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

<!--Scribts Base And Vendor
================================-->


</body>
</html>
