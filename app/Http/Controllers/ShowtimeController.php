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


class ShowtimeController extends Controller
{
    public function doSelection( Request $request )
    {
        $rules = [ 'showtimeID' => 'required|integer'];
        $validation = Validator::make( $request->all(), $rules );
        if ( $validation->fails() ) {
            return Redirect::to( '/' )->withErrors( 'Seans Bulunamadı.' );
        }
        $showtime = Showtime::where( 'id', $request->showtimeID )->get()->first();
        $cityList = Helpers::cityList();
        return view( 'do_selection', [ 'showtime' => $showtime, 'cityList' => $cityList ] );
    }
}
