@include('header')
@include('sidebar')

<div class="main-contact">
    <h3 class="head">REZERVASYON</h3>


    <div class="contact-form">
        <form method="post" action="" id="do_reservation">
            <div class="col-md-6 contact-left">
                <input name="fullname" type="text" placeholder="İsim Soyisim" required/>
                <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                       title="Bu veri formata uygun değil." placeholder="E-mail" autocomplete="email" required/>
                <input name="phone" type="tel" minlength="11" maxlength="11"
                       title="Bu veri formata uygun değil." placeholder="Telefon" required/>
                <input name="idnumber" type="tel" minlength="11" maxlength="11"
                       title="Bu veri formata uygun değil." placeholder="TC Kimlik Numarası" required/>
                <input name="showtimeID" type="hidden" value="{{$showtime->id}}" required/>
                <input name="selectedSeat" type="hidden" value="{{$selectedSeat}}" required/>
                <input name="price" type="hidden" value="{{$price}}" required/>
                <input name="priceDetail" type="hidden" value="{{json_encode($priceDetail)}}" required/>
                <input type="submit" value="REZERVASYON YAP"/>
            </div>
            <div class="col-md-6 contact-right">
                <h4>Film: <span class="info-text">{{$showtime->movie->movie_name}}</span></h4>
                <h4>Seans: <span class="info-text"> {{$showtime->movie_time}} </span></h4>
                <h4>Sinema: <span class="info-text"> {{$cityList[$showtime->location]}} </span></h4>
                <h4>Koltuklar: <br/> <span class="info-text">
                @foreach ($priceDetail as $pDetail)
                            No: {{$pDetail->seatId}} - {{$pDetail->priceName}} - {{$pDetail->priceValue}}  ₺ <br/>
                        @endforeach
                </span></h4>
                <h4>Toplam Bedeli: <span class="info-text">{{$price}} ₺ </span></h4>
                <br/>
                <h4>
                    <img src="uploads/{{$showtime->movie->movie_poster}}" class="img-rounded">
                </h4>

            </div>
            <div class="clearfix"></div>
        </form>
    </div>

</div>

@include('footer')