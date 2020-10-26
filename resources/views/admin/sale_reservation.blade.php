@include('admin.header')
@include('admin.sidebar')


<script>
    $(document).ready(function () {

        $('button.fillInputsWithSame').click(function(){
            $('input[name=fullname]').val('{{$reservation->fullname}}');
            $('input[name=email]').val('{{$reservation->email}}');
            $('input[name=phone]').val('{{$reservation->phone}}');
            $('input[name=idnumber]').val('{{$reservation->idnumber}}');
        })


        function getPriceDetails() {
            var $priceDetails = {};
            $('.priceArea').find(":selected").each(function (e, d) {
                var priceName = $(this).text();
                var priceValue = $(this).val();
                var seatId = $(this).closest('select').data('seatid')
                $priceDetails[e] = {"priceName": priceName, "priceValue": priceValue, "seatId": seatId}
            });
            $('input[name=price_detail]').val(JSON.stringify($priceDetails));
            return $priceDetails;
        }

        function totalPrice(obj) {
            var $total = 0;
            $.each(obj, function (k, v) {
                $total += parseInt(v.priceValue)
            });
            $('input[name=price]').val($total);
            $('input[name=selected_seat]').val(getSelectedSeats());
            return $total;
        }

        function getSelectedSeats() {
            var $selectedSeats = [];
            $('.priceArea').find(":selected").each(function (e, d) {
                $selectedSeats[e] = $(this).closest('select').data('seatid')
            });
            return $selectedSeats;
        }


        $(".priceArea").on('change', 'select', function () {
            $('#total').text(totalPrice(getPriceDetails()));
        });

        var firstSeatLabel = 1;
        var $counter = $('#counter');
        var $total = $('#total');
        var sc = $('#seat-map').seatCharts({
            map: [
                '____fffff_fffff____',
                '___ffffff_ffffff___',
                '__fffffff_fffffff__',
                '_ffffffff_ffffffff_',
                'fffffffff_fffffffff',
                'fffffffff_fffffffff',
                'fffffffff_fffffffff',
                'fffffffff_fffffffff',
            ],
            seats: {
                f: {
                    price: 20,
                    classes: 'first-class', //your custom CSS class
                    category: 'Boş Koltuk'
                }
            },
            naming: {
                top: false,
                rows: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
                getId: function (character, row, column) {
                    return row + '_' + column;
                },
                getLabel: function (character, row, column) {
                    return column;
                }
            },
            legend: {
                node: $('#legend'),
                items: [
                    ['f', 'available', 'Boş Koltuk'],
                    ['f', 'unavailable', 'Seçili Koltuk']
                ]
            },

            click: function () {
                if (this.status() == 'available') {

                    $('<div class=" form-group" id="price-item-' + this.settings.id + '"> <label> ' + this.settings.id + ' </label>' +
                        '<select class="sel form-control" data-seatid="' + this.settings.id + '" >' +
                        '@foreach($priceList as $k =>$v ) <option value="{{$k}}">{{$v}} @endforeach' +
                        '</select>' +
                        '</div>')
                        .appendTo('.priceArea');

                    $counter.text(sc.find('selected').length + 1);
                    $total.text(totalPrice(getPriceDetails()));
                    return 'selected';

                } else if (this.status() == 'selected') {

                    $counter.text(sc.find('selected').length - 1);
                    $('#price-item-' + this.settings.id).remove();
                    $total.text(totalPrice(getPriceDetails()));
                    return 'available';

                } else if (this.status() == 'unavailable') {

                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        });


        //cancel
        $('#selected-seats').on('click', '.cancel-cart-item', function () {
            sc.get($(this).parents('li:first').data('seatId')).click();
        });

        $('#seat-map').seatCharts().get([ @php echo "'" . implode("','" ,  $reservationSeats) . "'"; @endphp ]).status('selected');

        $('#seat-map').seatCharts().get([
            @php
                $arr = array_diff($reservedSeats, $reservationSeats);
                echo "'" . implode("','" ,  $arr) . "'";
            @endphp
        ]).status('unavailable');


    })
</script>


<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Rezervasyon Satışı Gerçekleştir</h4>
                    </div>
                    <div class="content">


                        <div class="typo-line">


                            <h6 class="reservation-info-box">
                                <span class="icon-name">Rezervasyon Yapan Kişi</span>
                                <span class="ti-arrow-right"></span> <span class="red">{{$reservation->fullname}}
                                    , {{$reservation->email}} , {{$reservation->phone}}	</span> <br/>
                                <span class="icon-name ">Rezervasyon Yapılan Film</span> <span
                                        class="ti-arrow-right"> </span>
                                <span class="red">{{$reservation->showtime->movie->movie_name}}</span> <br/>
                                <span class="icon-name "> Rezervasyon Yapılan Seans</span> <span
                                        class="ti-arrow-right"></span>
                                <span class="red">{{$reservation->showtime->movie_time}}</span> <br/>
                                <span class="icon-name ">Rezervasyon Yapılan Sinema</span> <span
                                        class="ti-arrow-right"></span>
                                <span class="red">{{$cityList[$reservation->showtime->location]}}</span> <br/>
                                <span class="icon-name "> Rezervasyon Yapılan Koltuklar</span>
                                <span class="ti-arrow-right"></span> <span class="red">{{$reservation->seat}} </span> <br/>
                                <span class="icon-name "> Toplam Bedeli</span> <span
                                        class="ti-arrow-right"></span> <span class="red">{{$reservation->price}} ₺</span> <br/>
                            </h6>
<br />
                            <button class="btn btn-info btn-fill btn-wd fillInputsWithSame">Satış Bilgilerini Aynı Şekilde Doldur</button>
                            <br />
                            <br />
                        </div>


                        <form method="post" action="">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>İsim&Soyisim</label>
                                        <input name="fullname" type="text" class="form-control border-input"
                                               value="{{ old('fullname') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email"
                                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                               title="Bu veri formata uygun değil." class="form-control border-input"
                                               value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <input name="phone" type="tel" minlength="11" maxlength="11"
                                               title="Bu veri formata uygun değil." class="form-control border-input"
                                               value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>TC Kimlik Numarası</label>
                                        <input name="idnumber" type="tel" minlength="11" maxlength="11"
                                               title="Bu veri formata uygun değil." class="form-control border-input"
                                               value="{{ old('idnumber') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="booking-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="seat-map">
                                            <div class="front-indicator">Perde</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <h2>Detaylar</h2>

                                        <h3> Seçilen Koltuk: <span id="counter"
                                                                   style="font-weight: bold">{{count($reservationSeats)}}</span>
                                        </h3> <br/>
                                        <h3> Toplam Fiyat: <span id="total"
                                                                 style="font-weight: bold">{{$reservation->price}}</span>
                                        </h3> <br/>

                                        <div class="priceArea">

                                            @foreach($priceDetail as $pd)
                                                <div class=" form-group" id="price-item-{{$pd->seatId}}">
                                                    <label> {{$pd->seatId}} </label>
                                                    <select class="sel form-control" data-seatid="{{$pd->seatId}}">
                                                        @foreach($priceList as $k =>$v )
                                                            <option value="{{$k}}"
                                                                    @if ($k == $pd->priceValue)  selected="selected" @endif>{{$v}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div id="legend"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">

                                <input type="hidden" name="showtime_id" value="{{$reservation->showtime->id}}">
                                <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                                <input type="hidden" name="selected_seat" value="{{$reservation->seat}}">
                                <input type="hidden" name="price_detail" value="{{$reservation->price_detail}}">
                                <input type="hidden" name="price" value="{{$reservation->price}}">

                                <button type="submit" class="btn btn-info btn-fill btn-wd">Ekle</button>
                                <div class="clearfix"><br/></div>

                            </div>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<style>
</style>


@include('admin.footer')


