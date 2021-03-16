<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');

Route::get('/add_accomodation', 'AccomodationController@form');

Route::post('/add_accomodation', 'AccomodationController@add');

Route::get('/accomodation/{id}', 'AccomodationController@show');

Route::get('/browse', 'PagesController@browse');

Route::post('/browse', 'AccomodationController@filter');

Route::get('/my_accomodations', 'AccomodationController@my_accomodations');

Route::get('/edit/{id}', 'AccomodationController@edit');

Route::post('/edit/{id}', 'AccomodationController@update');

Route::get('/edit/pictures/{id}', 'ImageController@edit_pictures');

Route::get('/profile', 'UserController@profile');

Route::post('/update_profile', 'UserController@update_profile');

Route::post('/add_images/{id}', 'ImageController@add_images');

Route::delete('/delete/{id}', 'AccomodationController@delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
