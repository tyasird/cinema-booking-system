<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sinema Rezervasyon Projesi | Yönetim Paneli</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!-- Bootstrap core CSS     -->
    <link href="{{ url('') }}/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ url('') }}/assets/css_main/jquery.seat-charts.css" rel="stylesheet" type="text/css" media="all" />

    <!-- Animation library for notifications   -->
    <link href="{{ url('') }}/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Paper Dashboard core CSS    -->
    <link href="{{ url('') }}/assets/css/paper-dashboard.css" rel="stylesheet"/>
    <link href="{{ url('') }}/assets/css/custom.css" rel="stylesheet"/>
    <!--  Fonts and icons     -->
    <link href="{{ url('') }}/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('') }}/assets/css/themify-icons.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/css/jquery.datetimepicker.css" rel="stylesheet">


    <!--   Core JS Files   -->

    <script src="{{ url('') }}/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="{{ url('') }}/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ url('') }}/assets/js/bootstrap-checkbox-radio.js"></script>
    <script src="{{ url('') }}/assets/js/paper-dashboard.js"></script>
    <script src="{{ url('') }}/assets/js/jquery.datetimepicker.full.js"></script>
    <script src="{{ url('') }}/assets/js/admin-custom.js"></script>
    <script src="{{ url('') }}/assets/js_main/jquery.seat-charts.js" type="text/javascript"></script>
    <script src="{{ url('') }}/assets/js/bootstrap-notify.js"></script>


    @foreach($errors->all() as $error)
        <script>
            $(document).ready(function () {
            $.notify({message: " {{ $error }}"}, {type: 'danger', delay: 2000});
            })
        </script>
    @endforeach


</head>
<body>
