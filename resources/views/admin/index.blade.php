@include('admin.header')
@include('admin.sidebar')


<div class="content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-3">
                <div class="dash-box dash-box-color-1">
                    <div class="dash-box-icon">
                        <i class="fa fa-play"></i>
                    </div>
                    <div class="dash-box-body">
                        <span class="dash-box-count">{{$total['movie']}}</span>
                        <span class="dash-box-title">Film</span>
                    </div>

                    <div class="dash-box-action">
                        <button onclick="location.href='admin/add_movies'" >Film Ekle</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-box dash-box-color-2">
                    <div class="dash-box-icon">
                        <i class="fa fa-film"></i>
                    </div>
                    <div class="dash-box-body">
                        <span class="dash-box-count">{{$total['showtime']}}</span>
                        <span class="dash-box-title">Seans</span>
                    </div>

                    <div class="dash-box-action">
                        <button onclick="location.href='admin/add_showtimes'" >Seans Ekle</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-box dash-box-color-3">
                    <div class="dash-box-icon">
                        <i class="fa fa-save"></i>
                    </div>
                    <div class="dash-box-body">
                        <span class="dash-box-count">{{$total['reservation']}}</span>
                        <span class="dash-box-title">Rezervasyon</span>
                    </div>

                    <div class="dash-box-action">
                        <button onclick="location.href='admin/reservations'" >Rezervasyonlar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-box dash-box-color-3">
                    <div class="dash-box-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="dash-box-body">
                        <span class="dash-box-count">{{$total['sale']}}</span>
                        <span class="dash-box-title">Satış</span>
                    </div>

                    <div class="dash-box-action">
                        <button onclick="location.href='admin/sales'" >Satışlar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

