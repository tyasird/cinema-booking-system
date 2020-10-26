<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/', 'AdminController@Index');
Route::get('/admin/movies', 'AdminController@Movies');
Route::get('/admin/showtimes', 'AdminController@Showtimes');
Route::get('/admin/reservations', 'AdminController@Reservations');
Route::get('/admin/sales', 'AdminController@Sales');
Route::get('/admin/add_movies', 'AdminController@AddMovies');
Route::get('/admin/edit_movies', 'AdminController@EditMovies');
Route::get('/admin/add_showtimes', 'AdminController@AddShowtimes');
Route::get('/admin/edit_showtimes', 'AdminController@EditShowtimes');
Route::get('/admin/show_sales', 'AdminController@ShowSales');
Route::get('/admin/prices', 'AdminController@Prices');
Route::get('/admin/genres', 'AdminController@Genres');
Route::get('/admin/locations', 'AdminController@Locations');
Route::delete('/admin/delete_prices/{id}', 'AdminController@DeletePrices' );
Route::delete('/admin/delete_genres/{id}', 'AdminController@DeleteGenres' );
Route::delete('/admin/delete_locations/{id}', 'AdminController@DeleteLocations' );

Route::match(['get', 'post'],'/admin/add_prices', 'AdminController@AddPrices');
Route::match(['get', 'post'],'/admin/add_genres', 'AdminController@AddGenres');
Route::match(['get', 'post'],'/admin/add_locations', 'AdminController@AddLocations');
Route::match(['get', 'post'],'/admin/edit_prices', 'AdminController@EditPrices');
Route::match(['get', 'post'],'/admin/edit_genres', 'AdminController@EditGenres');
Route::match(['get', 'post'],'/admin/edit_locations', 'AdminController@EditLocations');

Route::match(['get', 'post'],'/admin/search_reservations','AdminController@SearchReservations');
Route::match(['get', 'post'],'/admin/search_sales','AdminController@SearchSales');
Route::match(['get', 'post'],'/admin/sale_reservation','AdminController@SaleReservation');
Route::match(['get', 'post'],'/admin/sale_new','AdminController@SaleNew');
Route::match(['get', 'post'],'/admin/admin_actions', 'AdminController@AdminActions');
Route::get('/admin/login', 'AdminController@showLogin');
Route::post('/admin/login','AdminController@doLogin');
Route::get('/admin/logout','AdminController@doLogout');

Route::get('/','HomeController@index');
Route::get('/index','HomeController@index');
Route::get('/show_movie','MovieController@showMovie');
Route::match(['get', 'post'],'/actions','HomeController@actions');
Route::match(['get', 'post'],'/do_reservation','ReservationController@doReservation');
Route::match(['get', 'post'],'/do_selection','ShowtimeController@doSelection');
Route::match(['get', 'post'],'/show_ticket','ReservationController@showTicket');
