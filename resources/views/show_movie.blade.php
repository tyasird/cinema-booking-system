@include('header')
@include('sidebar')


<div class="reviews-section">
    <h3 class="head">Film</h3>
    <div class="col-md-9 reviews-grids">
        <div class="review">
            <div class="movie-pic">
                <a href=""><img src="uploads/{{$movie->movie_poster}}" alt=""/></a>
            </div>
            <div class="review-info">
                <a class="span"> <i>{{$movie->movie_name}}</i></a>
                <p class="dirctr"></p>
                <p class="ratingview">Puanlama:</p>
                <div class="rating">
                    <span class="fa fa-star @php echo (rand(0,1)) ? 'checked' : '';@endphp"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <p class="ratingview"></p>
                <div class="clearfix"></div>


                <p class="info">Tür: &nbsp;&nbsp;&nbsp;&nbsp;

                    @foreach($genreList as $key=>$value)
                        @php
                            if (in_array($key, explode(',',$movie->movie_genre))){
                                echo '<span class="label label-warning">'.$genreList[$key].'</span>';
                            }
                        @endphp
                    @endforeach
                </p>

                <div class="clearfix"></div>
                <p>Konu: &nbsp;&nbsp;&nbsp;&nbsp;
                    <i> {{$movie->movie_detail}}</i>
                </p>


                <div class="yrw">

                    <p class="info-text">Sinema ve Seans Seçimi</p>
                    <div class="dropdown-button">
                        <select name="location" id="select_location" data-movie_id="{{$movie->id}}" class="dropdown"
                                tabindex="9">
                            <option value="0">- Sinema Seçiniz -</option>
                            @foreach( $showtimes  as $k=>$showtime)
                                <option value="{{ $showtime['location'] }}">{{ $cityList[$showtime['location']] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>

                    <div class="listShowtimes">
                        <p class="info-text">Seanslar</p>
                        <ul></ul>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>


    <div class="col-md-3 side-bar">


        <div class="might">
            <h3>Gösterime Girenler</h3>
            @foreach ($recentMovies as $recentmovie)
                <div class="might-grid">
                    <div class="grid-might">
                        <a href="show_movie?id={{$recentmovie->id}}"><img src="uploads/{{$recentmovie->movie_poster}}"
                                                                          class="img-responsive" alt=""> </a>
                    </div>
                    <div class="might-top">
                        <p>
                            @foreach($genreList as $key=>$value)
                                @php
                                    if (in_array($key, explode(',',$recentmovie->movie_genre))){
                                        echo '<span class="label label-warning">'.$genreList[$key].'</span>';
                                    }
                                @endphp
                            @endforeach
                        </p>
                        <a href="show_movie?id={{$recentmovie->id}}">{{$recentmovie->movie_name}}<i> </i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="clearfix"></div>
</div>
</div>


@include('footer')