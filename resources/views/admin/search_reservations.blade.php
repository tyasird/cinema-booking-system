@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Rezervasyon Listesi</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">İsim</th>
                            <th style="width: 15%">Koltuk</th>
                            <th style="width: 30%">Film</th>
                            <th style="width: 15%">Seans</th>
                            <th style="width: 20%">İşlem</th>
                            </thead>
                            <tbody>


                            <div class="row">
                                <div class="col-md-4">
                                    {{ $reservations->links() }}
                                </div>
                                <form action="search_reservations" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-4 col-md-push-2">
                                        <div class="form-group" style="margin-top: 15px;">
                                            <input name="search" type="text" class="form-control border-input"
                                                   placeholder="İsim, Soyisim, Telefon veya Koltuk NO giriniz">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-push-2" style="margin-top: 15px;">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd"
                                               value="Rezervasyon Ara">
                                    </div>
                                </form>
                            </div>

                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{$reservation->id}}</td>
                                    <td>{{$reservation->fullname}}</td>
                                    <td>{{$reservation->seat}}</td>
                                    <td>{{$reservation->showtime['movie_time']}}</td>
                                    <td>{{$reservation->showtime->movie->movie_name}}</td>
                                    <td>
                                        <a href="sale_reservation?reservationId={{$reservation->id}}">
                                            <i class="fa fa-print"></i> Satış Gerçekleştir</a>

                                        <a href="#" data-reservationid="{{$reservation->id}}"
                                           class="delete_reservations"><i class="fa fa-minus-square"></i> Sil</a>

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@include('admin.footer')
