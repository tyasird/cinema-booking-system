
<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    YÖNETİM PANELİ
                </a>
            </div>

            <ul class="nav">
                <li class="{{ Request::is('admin') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/">
                        <i class="ti-panel"></i>
                        <p>Anasayfa</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/*movies') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/movies">
                        <i class="ti-desktop"></i>
                        <p>Filmler</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/*showtimes') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/showtimes">
                        <i class="ti-calendar"></i>
                        <p>Seanslar</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/*reservations') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/reservations">
                        <i class="ti-ticket"></i>
                        <p>Rezervasyonlar</p>
                    </a>
                </li>

                <li class="{{ Request::is('admin/*sales') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/sales">
                        <i class="ti-shopping-cart-full"></i>
                        <p>Satışlar</p>
                    </a>
                </li>


                <li class="{{ Request::is('admin/*prices') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/prices">
                        <i class="ti-money"></i>
                        <p>Bilet Türleri</p>
                    </a>
                </li>


                <li class="{{ Request::is('admin/*genres') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/genres">
                        <i class="ti-tag"></i>
                        <p>Film Kategorileri</p>
                    </a>
                </li>


                <li class="{{ Request::is('admin/*locations') ? 'active' : '' }}">
                    <a href="{{ url('') }}/admin/locations">
                        <i class="ti-location-pin"></i>
                        <p>Sinemalar</p>
                    </a>
                </li>


            </ul>
    	</div>
    </div>

    <div class="main-panel">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">


                        <li>
                            <a href="{{ url('') }}">
                                <i class="fa fa-laptop"></i>
                                <p>UYGULAMA</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('') }}/admin/logout">
                                <i class="ti-user"></i>
                                <p>ÇIKIŞ</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
