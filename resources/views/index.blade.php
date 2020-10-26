@include('header')
@include('sidebar')




    <div class="right-content">
        <div class="right-content-heading">
            <div class="right-content-heading-left">
                <h3 class="head">VİZYONDAKİ FİLMLER</h3>
            </div>
        </div>


        <div class="content-grids">
            @php $key = 1 @endphp
            @foreach ($movies as $movie)
                <div class="content-grid  {{ ($key % 4  == 0 && $key <> 1  ) ? 'last-grid' : ''}}">
                    <a class="play-icon" href="show_movie?id={{$movie->id}}"><img src="uploads/{{$movie->movie_poster}}"></a>
                    <div class="fix"><h3>{{$movie->movie_name}}</h3></div>
                    <a class="button" href="show_movie?id={{$movie->id}}">Rezervsayon Yap</a>
                </div>
                @php $key++ @endphp
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>


    <div class="review-slider">
        <ul id="flexiselDemo1">
            @foreach ($movies as $movie)
                <li><a href="show_movie?id={{$movie->id}}"><img width=100 height=150 src="uploads/{{$movie->movie_poster}}" alt=""/></a></li>
            @endforeach
        </ul>

    </div>


</div>


@include('footer')