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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/login', function () {
    return view('auth/login');
});

// Ajax Route for Card Holder's Information
 Route::post('/getCardInfo', 'AjaxController@cardHolder');

// Deleting driver
Route::get('/driver/delete/{driver}', 'DriverController@destroy')->name('driver.delete');

// Deleting bus
Route::get('/bus/delete/{bus}', 'BusController@destroy')->name('bus.delete');

// Deleting route
Route::get('/route/delete/{route}', 'RouteController@destroy')->name('route.delete');

// Deleting endpoint
Route::get('/endpoint/delete/{endPoint}', 'EndPointController@destroy')->name('endpoint.delete');

//Registering an Admin
Route::post('/register_admin', 'UserController@store')->name('register_admin');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController');
Route::resource('end_points', 'EndPointController');
Route::resource('routes', 'RouteController');
Route::resource('drivers', 'DriverController');
Route::resource('buses', 'BusController');
Route::resource('commuters', 'CommuterController');
Route::resource('card', 'CardController');
Route::resource('trips', 'TripController');

Route::get('/admins', 'UserController@admins')->name('admins');

