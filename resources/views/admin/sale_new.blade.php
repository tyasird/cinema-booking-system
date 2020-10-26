@include('admin.header')
@include('admin.sidebar')


<script>
    $(document).ready(function () {

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

        $('#seat-map').seatCharts().get([
            @php
                echo "'" . implode("','" ,  $reservedSeats) . "'";
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
                        <h4 class="title">Bilet Satışı Gerçekleştir</h4>
                    </div>
                    <div class="content">

                        <div class="typo-line">
                            <h6 class="reservation-info-box">
                                <span class="icon-name ">Film</span> <span class="ti-arrow-right"> </span>
                                <span class="red">{{$showtime->movie->movie_name}}</span> <br/>
                                <span class="icon-name ">Seans</span> <span class="ti-arrow-right"></span>
                                <span class="red">{{$showtime->movie_time}}</span> <br/>
                                <span class="icon-name ">Sinema</span> <span class="ti-arrow-right"></span>
                                <span class="red">{{$cityList[$showtime->location]}}</span> <br/>
                            </h6>
                        </div>


                        <form method="post" action="">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>İsim&Soyisim</label>
                                        <input required name="fullname" type="text" class="form-control border-input"
                                               value="{{ old('fullname') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input required name="email" type="email"
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
                                        <input required name="phone" type="tel" minlength="11" maxlength="11"
                                               title="Bu veri formata uygun değil." class="form-control border-input"
                                               value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>TC Kimlik Numarası</label>
                                        <input required name="idnumber" type="tel" minlength="11" maxlength="11"
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
                                        <h3> Seçilen Koltuk: <span id="counter" style="font-weight: bold">0</span></h3><br/>
                                        <h3> Toplam Fiyat: <span id="total" style="font-weight: bold">0</span></h3><br/>

                                        <div class="priceArea"></div>
                                        <div id="legend"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="text-center">

                                <input type="hidden" name="showtime_id" value="{{$showtime->id}}">
                                <input type="hidden" name="selected_seat" value="">
                                <input type="hidden" name="price_detail" value="">
                                <input type="hidden" name="price" value="">

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


