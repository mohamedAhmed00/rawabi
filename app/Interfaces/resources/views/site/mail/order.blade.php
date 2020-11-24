<!DOCTYPE html>
<html>
    <head>
        <title>طلب جديد</title>
    </head>
    <body>
        <h1>هذه رساله من  : {{ $request->name }} </h1>
        <span> رقم الهاتف : {{ $request->phone }}</span><br>
        <span> المدينه : {{ $request->city }}</span><br>
        <span> العنوان : {{ $request->address }}</span><br>
        <span> طريقة التواصل : {{ $request->receive }}</span><br>
        <span> طريقه الدفع : {{ $request->payment }}</span><br>
        <span> <a href="https://www.google.com/maps?q={{ $request->location }}"> افتح العنوان علي الخريطة </a></span><br>

        @foreach($products as $product)
            <span> اسم المنتج : {{ $product->name }}</span><br>
            <span> كميه المنتج : {{ $product->qty }}</span><br>
            <span> سعر المنتج : {{ $product->price }}</span><br>
            <span> الحجم : {{ $product->options['kind'] }}</span><br>
            <span> نوع الذبيحه : {{ $product->options['type'] }}</span><br>
            @if($product->options['type'] != 'حي')
                <span> طريقه التقطيع : {{ $product->options['cutting'] }}</span><br>
                @if($settings['packing'] == 1)
                    <span> طريقه التغليف : {{ $product->options['packing'] }}</span><br>
                @endif
                    <span>مفروم : {{ $product->options['minced'] }}</span><br>
                @if($product->options['minced'] == 'نعم')
                    <span>كم كيلو : {{ $product->weight }}</span><br>
                @endif
                @if($settings['head'] == 1)
                    <span> الراس : {{ $product->options['head'] }}</span><br>
                @endif
            @endif
            <span> التعليقات : {{ $product->options['comments'] }}</span><br>
            <span> الضريبة : {{ $request->tax  }}</span><br>
            <span> اجمالي المبلغ : {{ $request->price }}</span><br>
        @endforeach
    </body>
</html>
