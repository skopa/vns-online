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
    return view('pages.welcome');
})->name('welcome');

Route::get('/login', 'AuthController@redirectToProvider')
    ->name('login');

Route::get('/oauth2callback', 'AuthController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::get('/home', 'ProfileController@home')->name('home');

    Route::get('/profile', 'ProfileController@show')
        ->name('profile.show');

    Route::put('/profile', 'ProfileController@update')
        ->name('profile.update');

    Route::resource('/visitTimeLines', 'VisitTimeLineController');

    Route::resource('/links', 'LinkController');

    Route::post('/links/preview', 'LinkController@preview');

    Route::get('/linkClicks', 'LinkClickController')->name('clicks');
});