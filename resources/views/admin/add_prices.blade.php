@include('admin.header')
@include('admin.sidebar')

<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Fiyat Ekle</h4>
                    </div>
                    <div class="content">
                        <form method="post" action="">

                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fiyat Değeri</label>
                                        <input  required name="price_value" type="number" class="form-control border-input"
                                               placeholder="" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fiyatlandırma İsmi</label>
                                        <input required name="price_name" type="text" class="form-control border-input"
                                               placeholder="" value="">
                                    </div>
                                </div>
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Ekle</button>
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
