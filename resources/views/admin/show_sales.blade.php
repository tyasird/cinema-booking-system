<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sinema Rezervasyon Projesi | Yönetim Paneli</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link href=" {{ url('') }}/assets/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="{{ url('') }}/assets/css/custom.css" rel="stylesheet"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>


</head>
<body style="background:url('https://unsplash.it/800/1200/?random');
    background-size:cover;
    background-color: gray">


<div class="contenido">
    <div class="ticket">
        <div class="hqr">
            <div class="column left-one"></div>
            <div class="column center">
                <div id="qrcode"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{$sale->idnumber}}-{{$sale->phone}}&size=120x120&margin=0"></div>
            </div>
            <div class="column right-one"></div>
        </div>
    </div>
    <div class="details">
        <div class="tinfo">
            Kişi
        </div>
        <div class="tdata name">
            {{$sale->fullname}}
        </div>
        <div class="tinfo">
            Koltuk No / Fiyat
        </div>
        <div class="tdata name">
            {{$sale->seat}} /  {{$sale->price}} ₺

        </div>
        <div class="tinfo">
            Kimlik / Telefon
        </div>
        <div class="tdata">
            {{$sale->idnumber}} /  {{$sale->phone}}
        </div>
        <div class="tinfo">
            Film
        </div>
        <div class="tdata">
            {{$sale->showtime->movie->movie_name}}
        </div>
        <div class="masinfo">
            <div class="left">
                <div class="tinfo">
                    Tarih
                </div>
                <div class="tdata nesp">
                    {{ Carbon\Carbon::parse($sale->showtime['movie_time'])->format('d-m-Y H:i')  }}
                </div>
            </div>
            <div class="right">
                <div class="tinfo">
                    Sinema
                </div>
                <div class="tdata nesp">
                    {{ $cityList[$sale->showtime->location] }}
                </div>
            </div>
        </div>

        <div class="link non-printable">
            <a onclick="window.close();" href="#">Kapat</a> - <a onClick="window.print()" href="#">Yazdır</a>
        </div>

    </div>
</div>
</div>

</body>