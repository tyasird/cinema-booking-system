@include('admin.header')
@include('admin.sidebar')


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Film Listesi  <a href="{{ url('') }}/admin/add_movies" style="float:right" class="btn btn-info btn-fill btn-wd" >Yeni Film Ekle</a></h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th style="width: 5%">ID</th>
                                    	<th style="width: 20%">Poster</th>
                                    	<th style="width: 55%">Film</th>
                                    	<th style="width: 20%">İşlem</th>
                                    </thead>
                                    <tbody>


                                    {{ $movies->links() }}

                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>{{$movie->id}}</td>
                                            <td><img style="max-width: 40%;" src="../uploads/{{$movie->movie_poster}}" class="img-rounded" ></td>
                                            <td>{{$movie->movie_name}}</td>
                                            <td>
                                                <a href="edit_movies?id={{$movie->id}}" ><i class="fa fa-edit"></i> Düzenle</a>
                                                <a href="#" data-movieid="{{$movie->id}}" class="delete_movies" ><i class="fa fa-minus-square"></i> Sil</a>
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
