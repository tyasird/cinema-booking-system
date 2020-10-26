<!-- header-section-starts -->
<div class="full">
    <div class="menu">
        <ul>
            <li>
                <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{url('')}}">
                    <div class="hm"><i class="home1"></i><i class="home2"></i></div>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('show_movie') ? 'active' : '' }}" >
                    <div class="cat"><i class="videos"></i><i class="videos1"></i></div>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('do_selection') ? 'active' : '' }}" >
                    <div class="bk"><i class="booking"></i><i class="booking1"></i></div>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('do_reservation') ? 'active' : '' }}">
                    <div class="bk"><i class="contact"></i><i class="contact1"></i></div>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('show_ticket') ? 'active' : '' }}" >
                    <div class="cat"><i class="watching"></i><i class="watching1"></i></div>
                </a>
            </li>
        </ul>
    </div>
    <div class="main">

        <div class="video-content">
            <div class="top-header span_top">
                <div class="logo">
                    <a href="{{url('')}}"><img src="assets/img_main/logo.png"/></a>
                </div>

                <div class="clearfix"></div>
            </div>
