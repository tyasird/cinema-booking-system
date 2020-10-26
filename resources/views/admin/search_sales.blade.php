@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Satış Listesi</h4>
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
                                    {{ $sales->links() }}
                                </div>
                                <form action="search_sales" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-1" style="margin-top: 20px; padding-left:50px; color:red; ">
                                        <span class="fa fa-calendar-alt fa-2x" id='datetimepicker2'></span>
                                    </div>
                                    <div class="col-md-5 ">
                                        <div class="form-group" style="margin-top: 15px;">
                                            <input name="search" type="text" class="form-control border-input"
                                                   placeholder="İsim, Soyisim, Telefon, Tarih veya Koltuk NO giriniz"
                                                   value="{{old('search')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 15px;">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd" value="Satış Ara">
                                    </div>
                                </form>
                            </div>

                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{$sale->id}}</td>
                                    <td>{{$sale->fullname}}</td>
                                    <td>{{$sale->seat}}</td>
                                    <td>{{$sale->showtime['movie_time']}}</td>
                                    <td>{{$sale->showtime->movie->movie_name}}</td>
                                    <td>
                                        <a href="#"
                                           onclick="PopupCenter('show_sales?id='+ {{$sale->id}}, 'Yazdır', 500, 500)">
                                            <i class="fa fa-print"></i> Bilet Yazdır</a>
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
