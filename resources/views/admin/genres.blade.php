@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tür Listesi  <a href="{{ url('') }}/admin/add_genres" style="float:right" class="btn btn-info btn-fill btn-wd" >Yeni Tür Ekle</a></h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                            <th style="width: 5%">ID</th>
                            <th style="width: 75%">Tür İsmi</th>
                            <th style="width: 20%">İşlem</th>
                            </thead>
                            <tbody>


                            @foreach ($genres as $genre)
                                <tr>
                                    <td>{{$genre->id}}</td>
                                    <td>{{$genre->genre_name}}</td>
                                    <td>
                                        <a href="edit_genres?id={{$genre->id}}" ><i class="fa fa-edit"></i> Düzenle</a>

                                        <form action="delete_genres/{{$genre->id}}" method="POST" style="display: inline-table">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type='submit' class="btn btn-outline-primary btn-sm" > <i class="fa fa-minus-square"></i> sil</button>
                                        </form>

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
