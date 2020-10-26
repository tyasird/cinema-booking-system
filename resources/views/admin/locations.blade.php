@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Sinema Listesi  <a href="{{ url('') }}/admin/add_locations" style="float:right" class="btn btn-info btn-fill btn-wd" >Yeni Sinema Ekle</a></h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                            <th style="width: 5%">ID</th>
                            <th style="width: 75%">Sinema Adı</th>
                            <th style="width: 20%">İşlem</th>
                            </thead>
                            <tbody>



                            @foreach ($locations as $location)
                                <tr>
                                    <td>{{$location->id}}</td>
                                    <td>{{$location->location_name}}</td>
                                    <td>
                                        <a href="edit_locations?id={{$location->id}}" ><i class="fa fa-edit"></i> Düzenle</a>

                                        <form action="delete_locations/{{$location->id}}" method="POST" style="display: inline-table">
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
