@include('admin.header')
@include('admin.sidebar')

<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tür Düzenle</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="">

                            {{ csrf_field() }}


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tür İsmi</label>
                                        <input required name="genre_name" type="text" class="form-control border-input"
                                               placeholder=""  value="{{$genre->genre_name}}">
                                    </div>
                                </div>
                            </div>



                            <div class="text-center">
                                <input type="hidden" name="id" value="{{$genre->id}}">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Düzenle</button>
                            </div>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@include('admin.footer')
