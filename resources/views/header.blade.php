
<!DOCTYPE html>
<html>
<head>
    <title>Sinema Rezervasyon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="assets/css_main/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="assets/css_main/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css_main/jquery.seat-charts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css_main/custom.css" rel="stylesheet" type="text/css" media="all" />

    <script src="assets/js_main/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js_main/jquery.flexisel.js"></script>
    <link href="assets/css_main/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css_main/animate.min.css" rel="stylesheet" type="text/css" media="all" />
    <script src="assets/js_main/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="assets/js_main/bootstrap-notify.js" type="text/javascript"></script>
    <script src="assets/js_main/jquery.seat-charts.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js_main/custom.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>

@foreach($errors->all() as $error)
    <script>
        $.notify({message: " {{ $error }}"}, {type: 'danger', delay: 2000});
    </script>
@endforeach