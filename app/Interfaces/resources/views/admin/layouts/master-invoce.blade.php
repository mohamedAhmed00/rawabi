<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | روابي</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/fivicon.jpeg')}}">
    <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/bootstrap/bootstrap-ar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style-invoice.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@yield('content')
<!--Scribts Base And Vendor
================================-->
<script src="{{asset('assets/admin/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/admin/vendor/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('assets/admin/js/jspdf.min.js')}}"></script>
<script>
    var doc = new jsPDF();
    doc.text(20, 20, 'Hello world!');
    doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
    doc.addPage();
    doc.text(20, 20, 'Do you like that?');
    doc.output('datauri');
</script>
</body>
</html>
