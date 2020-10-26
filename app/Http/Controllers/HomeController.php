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


class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate( 8 );
        return view( 'index', [ 'movies' => $movies ] );
    }

    public function actions( Request $request )
    {
        $action = $_GET['action'];
        $r = new \stdClass();
        $r->result = 0;

        switch ( $action ):

            case 'do_reservation':

                $rules = [ 'fullname' => 'required', 'email' => 'required', 'phone' => 'required', 'idnumber' => 'required', 'showtimeID' => 'required', 'selectedSeat' => 'required', 'price' => 'required' ];
                $validation = Validator::make( $request->all(), $rules );
                if ( $validation->fails() ) {
                    $r->message = 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.';
                } else {
                    try {
                        $add = new Reservation();
                        $add->fullname = $request->fullname;
                        $add->email = $request->email;
                        $add->phone = $request->phone;
                        $add->idnumber = $request->idnumber;
                        $add->showtime_id = $request->showtimeID;
                        $add->seat = $request->selectedSeat;
                        $add->price = $request->price;
                        $add->price_detail = $request->priceDetail;
                        $add->save();

                        $update = Showtime::find( $request->showtimeID );
                        if ( !empty( $update->booking )){
                            $addReservation = $update->booking . "," . $request->selectedSeat;
                            $update->booking = $addReservation;
                        }else{
                            $update->booking = $request->selectedSeat;
                        }
                        $update->save();

                        $r->result = 1;
                    } catch ( \Exception $e ) {
                        $r->message = $e->getMessage();
                    }
                }
            break;

            case 'get_showtimes':

                $showtimes = Showtime::where( 'location', $request->locationID )->where( 'movie_id', $request->movieID )->where( 'movie_time', '>=', now() )->orderBy( 'movie_time', 'ASC' )->get();
                if ( $showtimes ) {
                    $r->showtimes = $showtimes;
                    $r->result = 1;
                } else {
                    $r->message = "Seans Bulunamadı.";
                }
            break;

            default:
            break;

        endswitch;

        echo json_encode( $r );
    }


}
