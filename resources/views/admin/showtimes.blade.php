@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Seans Listesi <a href="{{ url('') }}/admin/add_showtimes" style="float:right"
                                                           class="btn btn-info btn-fill btn-wd">Yeni Seans Ekle</a></h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table">
                            <thead>
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">Salon</th>
                            <th style="width: 30%">Film</th>
                            <th style="width: 15%">Seans</th>
                            <th style="width: 30%">İşlem</th>
                            </thead>
                            <tbody>


                            <div class="row">
                                <div class="col-md-4">
                                    {{ $showtimes->appends(request()->query())->links() }}
                                </div>
                                <form action="search_showtimes" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-4 col-md-push-4">
                                        <div class="form-group" style="margin-top: 15px;">
                                            <select class="form-control border-input" onchange="javascript:location.href = this.value;">
                                                <option value="showtimes">Film Filtreleme - Tüm Filmleri Göster</option>
                                                @foreach($movies as $movie)
                                                    <option value="showtimes?movieId={{$movie->id}}" @if(request()->get('movieId') == $movie->id) selected="selected" @endif>{{$movie->movie_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="typo-line">
                                <h6 class="reservation-info-box">
                                    <span class="text-warning"> Bilgi: Renkli sütunların seans saati geçmiştir. Bilet satışı yaparken dikkat ediniz.</span>
                                </h6>
                            </div>

                            @foreach ($showtimes as $showtime)
                                <tr  @if($showtime->movie_time < date('Y-m-d H:i:s', time()) ) class="danger" @endif>
                                    <td>{{$showtime->id}}</td>
                                    <td>{{$cityList[$showtime->location]}}</td>
                                    <td>{{$showtime->movie['movie_name']}}</td>
                                    <td>{{$showtime->movie_time}}</td>
                                    <td>
                                        <a href="sale_new?showtimeId={{$showtime->id}}"><i class="fa fa-ticket-alt"></i>
                                            Bilet Satışı</a>
                                        <a href="edit_showtimes?id={{$showtime->id}}"><i class="fa fa-edit"></i> Düzenle</a>
                                        <a href="#" data-showtimeid="{{$showtime->id}}" class="delete_showtimes"><i
                                                    class="fa fa-minus-square"></i> Sil</a>

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
