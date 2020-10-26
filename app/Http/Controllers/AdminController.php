<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Helpers\Helpers;
use App\Location;
use App\Movie;
use App\Price;
use App\Reservation;
use App\Sale;
use App\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function Index()
    {
        $total['movie'] = Movie::get()->count();
        $total['showtime'] = Showtime::get()->count();
        $total['reservation'] = Reservation::get()->count();
        $total['sale'] = Sale::get()->count();
        return view( 'admin.index', [ 'total' => $total ] );
    }

    public function showLogin()
    {
        return view( 'admin.login' );
    }

    public function doLogout()
    {
        Auth::logout();
        return Redirect::to( 'admin/login' );
    }

    public function doLogin( Request $request )
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $validation = Validator::make( $request->all(), $rules );
        if ( $validation->fails() ) {
            return Redirect::to( 'admin/login' )->withErrors( $validation )// send back all errors to the login form
            ->withInput( Input::except( 'password' ) ); // send back the input (not the password) so that we can repopulate the form
        } else {

            $userdata = array(
                'name' => $request->username,
                'password' => $request->password
            );

            if ( Auth::attempt( $userdata ) ) {
                return Redirect::to( 'admin/' );
            } else {
                return Redirect::to( 'admin/login' )->withErrors( 'Giriş Bilgileri Yanlış' );
            }

        }
    }

    public function Movies()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $movies = DB::table( 'movies' )->paginate( 10 );
        return view( 'admin.movies', [ 'movies' => $movies ] );
    }

    public function Showtimes( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        if ( $request->movieId ):
            $showtimes = Showtime::where( 'movie_id', $request->movieId )->orderBy('id', 'desc')->paginate( 5 );
        else:
            $showtimes = Showtime::orderBy('id', 'desc')->paginate( 5 );
        endif;

        $cityList = Helpers::cityList();
        $movies = Movie::all();
        return view( 'admin.showtimes', [
            'showtimes' => $showtimes,
            'cityList' => $cityList,
            'movies' => $movies
        ] );
    }

    public function Prices()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $prices = Price::all();
        return view( 'admin.prices', [ 'prices' => $prices ] );
    }

    public function Genres()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $genres = Genre::all();
        return view( 'admin.genres', [ 'genres' => $genres ] );
    }

    public function Locations()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $locations = Location::all()->sortBy("location_name");
        return view( 'admin.locations', [ 'locations' => $locations ] );
    }

    public function Sales()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $sales = Sale::paginate( 5 );
        return view( 'admin.sales', [ 'sales' => $sales ] );
    }


    public function Reservations()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $reservations = Reservation::paginate( 5 );
        return view( 'admin.reservations', [ 'reservations' => $reservations ] );
    }

    public function ShowSales( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $id = $request->id;
        $cityList = Helpers::cityList();
        $sale = Sale::where( 'id', $id )->firstOrFail();
        return view( 'admin.show_sales', [
            'sale' => $sale,
            'cityList' => $cityList
        ] );
    }


    public function SearchSales( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $request->flash();
        $search = $request->search;
        $query = Sale::where( 'fullname', 'LIKE', '%' . $search . '%' )->orWhere( 'phone', 'LIKE', '%' . $search . '%' )->orWhere( 'seat', 'LIKE', '%' . $search . '%' )->orWhere( 'created_at', 'LIKE', '%' . $search . '%' );
        $sales = $query->paginate( 5 );
        return view( 'admin.search_sales', [ 'sales' => $sales ] )->withInput( Input::all() );
    }


    public function SearchReservations( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $search = $request->search;
        $query = Reservation::where( 'fullname', 'LIKE', '%' . $search . '%' )->orWhere( 'phone', 'LIKE', '%' . $search . '%' )->orWhere( 'seat', 'LIKE', '%' . $search . '%' );
        $reservations = $query->paginate( 5 );
        return view( 'admin.search_reservations', [ 'reservations' => $reservations ] );
    }


    public function SaleReservation( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $cityList = Helpers::cityList();
        $priceList = Helpers::priceList();
        $reservation = Reservation::where( 'id', $request->reservationId )->firstOrFail();
        $priceDetail = json_decode( $reservation->price_detail );
        $reservedSeats = explode( ',', $reservation->showtime->booking );
        $reservationSeats = explode( ',', $reservation->seat );

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) {
            $rules = [
                'showtime_id' => 'required',
                'reservation_id' => 'required',
                'selected_seat' => 'required',
                'price_detail' => 'required',
                'price' => 'required',
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'idnumber' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ) {
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.' );
            } else {
                try {
                    $add = new Sale();
                    $add->fullname = $request->fullname;
                    $add->email = $request->email;
                    $add->phone = $request->phone;
                    $add->idnumber = $request->idnumber;
                    $add->showtime_id = $request->showtime_id;
                    $add->reservation_id = $request->reservation_id;
                    $add->seat = $request->selected_seat;
                    $add->price = $request->price;
                    $add->price_detail = $request->price_detail;
                    $add->save();

                    $update = Showtime::find( $request->showtime_id );
                    if ( !empty( $update->booking ) ):
                        $addReservation = $update->booking . "," . $request->selected_seat;
                        $update->booking = $addReservation;
                    else:
                        $update->booking = $request->selected_seat;
                    endif;
                    $update->save();

                    $update = Reservation::find( $request->reservation_id );
                    $update->sale = 1;
                    $update->save();

                    return Redirect::to( 'admin/sales' )->withErrors( 'Satış gerçekleştirildi.' );

                } catch ( \Exception $e ) {
                    return Redirect::to( 'admin/' )->withErrors( 'Kayıt hatası gerçekleşti.' );
                }
            }
        }

        return view( 'admin.sale_reservation', [
            'reservation' => $reservation,
            'priceList' => $priceList,
            'cityList' => $cityList,
            'priceDetail' => $priceDetail,
            'reservedSeats' => $reservedSeats,
            'reservationSeats' => $reservationSeats
        ] );

    }

    public function SaleNew( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $cityList = Helpers::cityList();
        $priceList = Helpers::priceList();
        $showtime = Showtime::where( 'id', $request->showtimeId )->firstOrFail();
        $reservedSeats = explode( ',', $showtime->booking );

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) {
            $rules = [
                'showtime_id' => 'required',
                'selected_seat' => 'required',
                'price_detail' => 'required',
                'price' => 'required',
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'idnumber' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ) {
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.' );
            } else {
                try {
                    $add = new Sale();
                    $add->fullname = $request->fullname;
                    $add->email = $request->email;
                    $add->phone = $request->phone;
                    $add->idnumber = $request->idnumber;
                    $add->showtime_id = $request->showtime_id;
                    $add->reservation_id = $request->reservation_id;
                    $add->seat = $request->selected_seat;
                    $add->price = $request->price;
                    $add->price_detail = $request->price_detail;
                    $add->save();

                    $update = Showtime::find( $request->showtime_id );
                    if ( !empty( $update->booking ) ):
                        $addReservation = $update->booking . "," . $request->selected_seat;
                        $update->booking = $addReservation;
                    else:
                        $update->booking = $request->selected_seat;
                    endif;
                    $update->save();

                    return Redirect::to( 'admin/sales' )->withErrors( 'Satış gerçekleştirildi.' );

                } catch ( \Exception $e ) {
                    return Redirect::to( 'admin/' )->withErrors( 'Kayıt hatası gerçekleşti.' );
                }
            }
        }

        return view( 'admin.sale_new', [
            'showtime' => $showtime,
            'priceList' => $priceList,
            'cityList' => $cityList,
            'reservedSeats' => $reservedSeats
        ] );

    }

    public function AddMovies()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $genreList = Helpers::genreList();
        return view( 'admin.add_movies', [ 'genreList' => $genreList ] );
    }

    public function AddPrices( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'price_value' => 'required',
                'price_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ) :
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $add = new Price();
                    $add->price_value = $request->price_value;
                    $add->price_name = $request->price_name;
                    $add->save();
                    return Redirect::to( 'admin/prices' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );

                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );

                }
            endif;
        endif;
        return view( 'admin.add_prices' );
    }


    public function AddGenres( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'genre_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ) :
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $add = new Genre();
                    $add->genre_name = $request->genre_name;
                    $add->save();
                    return Redirect::to( 'admin/genres' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );

                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );

                }
            endif;
        endif;
        return view( 'admin.add_genres' );
    }



    public function AddLocations( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'location_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ) :
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $add = new Location();
                    $add->location_name = $request->location_name;
                    $add->save();
                    return Redirect::to( 'admin/locations' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );

                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );

                }
            endif;
        endif;
        return view( 'admin.add_locations' );
    }



    public function EditPrices( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'id' => 'required',
                'price_value' => 'required',
                'price_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ):
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $update = Price::find( $request->id );
                    $update->price_value = $request->price_value;
                    $update->price_name = $request->price_name;
                    $update->save();
                    return Redirect::to( 'admin/prices' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );
                }
            endif;
        endif;


        return view( 'admin.edit_prices', [ 'price' => Price::find( $request->id ) ] );
    }

    public function EditGenres( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'id' => 'required',
                'genre_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ):
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $update = Genre::find( $request->id );
                    $update->genre_name = $request->genre_name;
                    $update->save();
                    return Redirect::to( 'admin/genres' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );
                }
            endif;
        endif;


        return view( 'admin.edit_genres', [ 'genre' => Genre::find( $request->id ) ] );
    }

    public function EditLocations( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }

        $method = $request->method();
        if ( $request->isMethod( 'post' ) ) :
            $rules = [
                'id' => 'required',
                'location_name' => 'required',
            ];
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->fails() ):
                return Redirect::back()->withInput( Input::all() )->withErrors( 'Bazı alanlar boş olduğu için işlem gerçekleştirilemedi.' );
            else:
                try {
                    $update = Location::find( $request->id );
                    $update->location_name = $request->location_name;
                    $update->save();
                    return Redirect::to( 'admin/locations' )->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
                } catch ( \Exception $e ) {
                    return Redirect::back()->withInput( Input::all() )->withErrors( $e->getMessage() );
                }
            endif;
        endif;


        return view( 'admin.edit_locations', [ 'location' => Location::find( $request->id ) ] );
    }

    public function DeletePrices(  $id )
    {
        Price::find( $id )->delete();
        return Redirect::back()->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
    }

    public function DeleteGenres(  $id )
    {
        Genre::find( $id )->delete();
        return Redirect::back()->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
    }

    public function DeleteLocations(  $id )
    {
        Location::find( $id )->delete();
        return Redirect::back()->withErrors( 'İşlem başarılı şekilde gerçekleşti.' );
    }

    public function EditMovies( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $genreList = Helpers::genreList();
        $id = $request->id;
        $movie = Movie::where( 'id', $id )->firstOrFail();
        return view( 'admin.edit_movies', [
            'movie' => $movie,
            'genreList' => $genreList
        ] );
    }


    public function AddShowtimes()
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $cityList = Helpers::cityList();
        $movies = Movie::all( 'id', 'movie_name' );
        return view( 'admin.add_showtimes', [
            'movies' => $movies,
            'cityList' => $cityList
        ] );
    }


    public function EditShowtimes( Request $request )
    {
        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $cityList = Helpers::cityList();
        $id = $request->id;
        $showtime = Showtime::where( 'id', $id )->firstOrFail();
        $movies = Movie::all( 'id', 'movie_name' );

        return view( 'admin.edit_showtimes', [
            'movies' => $movies,
            'showtime' => $showtime,
            'cityList' => $cityList
        ] );
    }

    public function AdminActions( Request $request )
    {

        if ( !Auth::user() ) {
            return Redirect::to( 'admin/login' )->withErrors( 'Yetkiniz Yok' );
        }
        $action = $_GET['action'];
        $response['result'] = 0;

        switch ( $action ) {

            case 'delete_movies':
                try {
                    $delete = Movie::where( 'id', $request->id )->delete();
                    $response['result'] = 1;
                } catch ( \Exception $e ) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode( $response );
            break;

            case 'delete_showtimes':
                try {
                    $delete = Showtime::where( 'id', $request->id )->delete();
                    $response['result'] = 1;
                } catch ( \Exception $e ) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode( $response );
            break;

            case 'delete_reservations':
                try {
                    $reservation = Reservation::where( 'id', $request->id )->firstOrFail();
                    $arr = array_diff( explode( ',', $reservation->showtime['booking'] ), explode( ',', $reservation->seat ) );
                    $newBooking = implode( ',', $arr );
                    Showtime::where( 'id', $reservation->showtime_id )->update( [ 'booking' => $newBooking ] );
                    $reservation->delete();
                    $response['result'] = 1;
                } catch ( \Exception $e ) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode( $response );
            break;



            case 'cancel_sales':
                try {
                    $sale = Sale::where( 'id', $request->id )->first();
                    if ( $sale->showtime ):
                        $arr = array_diff( explode( ',', $sale->showtime['booking'] ), explode( ',', $sale->seat ) );
                        $newBooking = implode( ',', $arr );
                        Showtime::where( 'id', $sale->showtime_id )->update( [ 'booking' => $newBooking ] );
                    endif;
                    Sale::where( 'id', $request->id )->update( [ 'status' => 2 ] );
                    $response['result'] = 1;
                } catch ( \Exception $e ) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode( $response );
            break;


            case 'delete_sales':
                try {
                    $sale = Sale::where( 'id', $request->id )->first();
                    $arr = array_diff( explode( ',', $sale->showtime['booking'] ), explode( ',', $sale->seat ) );
                    $newBooking = implode( ',', $arr );
                    Showtime::where( 'id', $sale->showtime_id )->update( [ 'booking' => $newBooking ] );
                    $sale->delete();
                    $response['result'] = 1;
                } catch ( \Exception $e ) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode( $response );
            break;

            case "upload_image":
                $handle = new \upload( $_FILES['file'] );
                if ( $handle->uploaded ) {
                    $newFileName = md5( time() );
                    $handle->file_new_name_body = $newFileName;
                    $handle->image_resize = TRUE;
                    $handle->image_x = 480;
                    $handle->image_ratio_y = TRUE;
                    $handle->process( 'uploads/' );
                    $handle->allowed = array( 'image/*' );
                    if ( $handle->processed ) {
                        $response['result'] = 1;
                        $response['newfilename'] = $newFileName . "." . $handle->file_src_name_ext;
                        $handle->clean();
                    } else {
                        $response['message'] = $handle->error;
                    }
                }
                echo json_encode( $response );
            break;


            case "add_movies":

                $rules = [
                    'movie_name' => 'required',
                    'movie_genre' => 'required',
                    'movie_detail' => 'required'
                ];
                $validation = Validator::make( $request->all(), $rules );
                if ( $validation->fails() ) {
                    $response['message'] = 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.';
                } else {
                    try {
                        $add = new Movie();
                        $add->movie_name = $request->movie_name;
                        $add->movie_genre = implode( ',', $request->movie_genre );
                        $add->movie_detail = $request->movie_detail;
                        $add->movie_poster = $request->movie_poster;
                        $add->save();
                        $response['result'] = 1;
                    } catch ( \Exception $e ) {
                        $response['message'] = $e->getMessage();
                    }
                }

                echo json_encode( $response );
            break;


            case "add_showtimes":

                $rules = [
                    'movie_id' => 'required',
                    'location' => 'required',
                    'movie_time' => 'required'
                ];
                $validation = Validator::make( $request->all(), $rules );
                if ( $validation->fails() ) {
                    $response['message'] = 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.';
                } else {
                    try {
                        $date = new \DateTime( $request->movie_time );
                        $add = new Showtime();
                        $add->movie_id = $request->movie_id;
                        $add->location = $request->location;
                        $add->movie_time = $date->format( 'Y-m-d H:i:s' );
                        $add->save();
                        $response['result'] = 1;
                    } catch ( \Exception $e ) {
                        $response['message'] = $e->getMessage();
                    }
                }
                echo json_encode( $response );
            break;


            case "edit_movies":

                $rules = [
                    'id' => 'required',
                    'movie_name' => 'required',
                    'movie_genre' => 'required',
                    'movie_detail' => 'required'
                ];
                $validation = Validator::make( $request->all(), $rules );
                if ( $validation->fails() ) {
                    $response['message'] = 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.';
                } else {
                    try {
                        $update = Movie::find( $request->id );
                        $update->movie_name = $request->movie_name;
                        $update->movie_detail = $request->movie_detail;
                        $update->movie_genre = implode( ',', $request->movie_genre );
                        $update->movie_poster = $request->movie_poster;
                        $update->save();
                        $response['result'] = 1;
                    } catch ( \Exception $e ) {
                        $response['message'] = $e->getMessage();
                    }
                }
                echo json_encode( $response );
            break;


            case "edit_showtimes":

                $rules = [
                    'id' => 'required',
                    'movie_id' => 'required',
                    'movie_time' => 'required',
                    'location' => 'required',
                ];
                $validation = Validator::make( $request->all(), $rules );
                if ( $validation->fails() ) {
                    $response['message'] = 'Bazı alanlar boş olduğu için kayıt işlemi gerçekleşmedi.';
                } else {
                    try {
                        $update = Showtime::find( $request->id );
                        $update->movie_id = $request->movie_id;
                        $update->movie_time = $request->movie_time;
                        $update->location = $request->location;
                        $update->location = $request->location;
                        $update->booking = $request->booking;
                        $update->save();
                        $response['result'] = 1;
                    } catch ( \Exception $e ) {
                        $response['message'] = $e->getMessage();
                    }
                }
                echo json_encode( $response );
            break;


            default:
                echo "Herhangi bir aksiyon belirlenemedi.";
        }

    }
}
