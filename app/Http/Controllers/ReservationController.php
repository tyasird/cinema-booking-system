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

class ReservationController extends Controller
{
    public function doReservation( Request $request )
    {
        $rules = [ 'showtimeID' => 'required|integer'];
        $validation = Validator::make( $request->all(), $rules );
        if ( $validation->fails() ) {
            return Redirect::to( '/' )->withErrors( 'Seans Bulunamadı.' );
        }
        $showtime = Showtime::where( 'id', $request->showtimeID )->get()->first();
        $cityList = Helpers::cityList();
        return view( 'do_reservation', [ 'showtime' => $showtime, 'cityList' => $cityList, 'price' => $request->price, 'priceDetail' => json_decode($request->priceDetail), 'selectedSeat' => $request->selectedSeat ] );
    }



    public function showTicket()
    {
        return view( 'show_ticket' );
    }

}
