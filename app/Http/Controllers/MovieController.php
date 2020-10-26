<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Movie;
use App\Reservation;
use App\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function showMovie( Request $request )
    {
        $rules = [ 'id' => 'required|integer' ];
        $validation = Validator::make( $request->all(), $rules );
        if ( $validation->fails() ) {
            return Redirect::to( '/' )->withErrors( 'Film Bulunamadı.' );
        } else {

            $cityList = Helpers::cityList();
            $genreList = Helpers::genreList();
            $recentMovies = Movie::limit( 5 )->get();
            $movie = Movie::where( 'id', $request->id )->get()->first();
            $showtimes = Showtime::where( 'movie_id', $request->id )->where('movie_time', '>=', now() )->orderBy('location', 'ASC')->get()->unique('location');
            return view( 'show_movie', [ 'movie' => $movie, 'showtimes' => $showtimes, 'cityList' => $cityList, 'genreList' => $genreList, 'recentMovies' => $recentMovies ] );
        }
    }


}
