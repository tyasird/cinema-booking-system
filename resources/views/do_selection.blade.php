@include('header')
@include('sidebar')

<script>
    $(document).ready(function () {

        $('#do_selection').submit(function (e) {
            e.preventDefault();
            var selectedSeat = $('#seat-map').seatCharts().find('selected').seatIds
            if (selectedSeat == '') {
                $.notify({message: "Devam etmek için koltuk seçmelisiniz."}, {type: 'danger', delay: 2000});
            } else {
                $('input[name=selectedSeat]').val(selectedSeat);
                $('input[name=price]').val(totalPrice(getPriceTypes()))
                $('input[name=priceDetail]').val(JSON.stringify(getPriceTypes()))
                $(this).unbind('submit').submit()
            }
        })


        function getPriceTypes() {
            var $priceTypes = {}
            $('.priceArea').find(":selected").each(function (e, d) {
                var priceName = $(this).text()
                var priceValue = $(this).val()
                var seatId = $(this).closest('select').data('seatid')
                $priceTypes[e] = {"priceName": priceName, "priceValue": priceValue, "seatId": seatId}
            });
            return $priceTypes;
        }

        function totalPrice(obj) {
            var $total = 0
            $.each(obj, function (k, v) {
                $total += parseInt(v.priceValue)
            });
            return $total;
        }


        $(".priceArea").on('change', 'select', function () {
            $('#total').text(totalPrice(getPriceTypes()));
        });

        var firstSeatLabel = 1;
        var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total'),
            sc = $('#seat-map').seatCharts({
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
                        //return firstSeatLabel++;
                    }
                },
                legend: {
                    node: $('#legend'),
                    items: [
                        //['e', 'available', 'Ekonomi Sınıfı'],
                        ['f', 'available', 'Boş Koltuk'],
                        ['f', 'unavailable', 'Seçili Koltuk']
                    ]
                },

                click: function () {
                    if (this.status() == 'available') {
                        //let's create a new <li> which we'll add to the cart items
                        $('<li>' + this.data().category + ' # ' + this.settings.id + ': <b>' + this.data().price + ' ₺</b> <a href="#" class="cancel-cart-item">[sil]</a></li>')
                            .attr('id', 'cart-item-' + this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);

                        $('<div class=" form-group" id="price-item-' + this.settings.id + '"> <label> ' + this.settings.id + ' </label>' +
                            '<select class="sel form-control" data-seatid="' + this.settings.id + '" >' +
                            '@foreach(\App\Helpers\Helpers::priceList() as $k =>$v ) <option value="{{$k}}">{{$v}}</option> @endforeach' +
                            '</select>' +
                            '</div>')
                            .appendTo('.priceArea');

                        $counter.text(sc.find('selected').length + 1);
                        $total.text(totalPrice(getPriceTypes()));

                        return 'selected';
                    } else if (this.status() == 'selected') {
                        $counter.text(sc.find('selected').length - 1);

                        //remove the item from our cart
                        $('#cart-item-' + this.settings.id).remove();
                        $('#price-item-' + this.settings.id).remove();
                        $total.text(totalPrice(getPriceTypes()));

                        //seat has been vacated
                        return 'available';
                    } else if (this.status() == 'unavailable') {
                        //seat has been already booked
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
                $all = explode(',',$showtime->booking);
                echo "'" . implode("','" ,  $all) . "'";
            @endphp
        ]).status('unavailable');


    })
</script>

<style>
    .priceArea {
        max-height: 185px;
        overflow-y: scroll;
    }

    .form-group label {
        float: left;
        text-align: left;
        font-weight: normal;
        margin: 10px;
        font-size: 14px;
        font-weight: bold;
    }

    .form-group select {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }


</style>


<div class="main-contact">
    <div>
        <h3 class="head">KOLTUK SEÇİMİ</h3>
        <br/>
        <h4>Film: <span class="info-text">{{$showtime->movie->movie_name}}</span></h4>
        <h4>Seans: <span class="info-text"> {{$showtime->movie_time}} </span></h4>
        <h4>Sinema: <span class="info-text"> {{$cityList[$showtime->location]}} </span></h4>
    </div>

    <div class="container">

        <div class="booking-details">
            <div class="row">
                <div class="col-md-8">
                    <div id="seat-map">
                        <div class="front-indicator">Perde</div>
                    </div>
                </div>
                <div class="col-md-4">

                    <form method="post" action="do_reservation" id="do_selection">
                        {{ csrf_field() }}
                        <input type="hidden" name="showtimeID" value="{{$showtime->id}}">
                        <input type="hidden" name="selectedSeat" value="">
                        <input type="hidden" name="price" value="">
                        <input type="hidden" name="priceDetail" value="">
                        <input type="submit" class="checkout-button btn btn-primary btn-lg btn-huge"
                               value="Rezervasyon Yap &raquo;">
                    </form>

                    <h2>Detaylar</h2>
                    <h3> Seçilen Koltuk (<span id="counter">0</span>)</h3> <br/>
                    <h3> Toplam Fiyat (<span id="total">0</span>)</h3> <br/>


                    <div class="priceArea"></div>

                    <div id="legend"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
