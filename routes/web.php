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

Route::get('test/{id}', function ($id) {
    dispatch(new \App\Jobs\PingOnlineJob(\App\User::find($id)));
});

Route::get('test', function () {
    /** @var \App\User $user */
    $user = \App\User::find(2);

    $curl = new \Curl\Curl();
    $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    $curl->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36 OPR/51.0.2830.26');

    $curl->setCookieFile(storage_path($user->cookies_file));
    $curl->setCookieJar(storage_path($user->cookies_file));


    $req = $curl->get('http://vns.lpnu.ua/course/view.php?id=4363');
    dd($curl);



    $curl->get('http://vns.lpnu.ua/local/intelliboard/ajax.php');
    $ping = $curl->response;

    if ($ping == "") {
        // $curl->get('http://vns.lpnu.ua/my');
        // if (str_contains($curl->getInfo()['url'], '/login')) {
        echo "WAS RE LOG IN!";
        $curl->post('http://vns.lpnu.ua/login/index.php', $user->vns_credentials, true);
        // }

        $user->cookies_and_login;

        $curl->get('http://vns.lpnu.ua/local/intelliboard/ajax.php');
    }

    ///$curl->coo

    //$req = $curl->get('http://vns.lpnu.ua/course/view.php?id=4167');

    //echo $curl->response;


    //$req = $curl->get('http://vns.lpnu.ua/message/index.php?id=27346');
    dd($curl);

    return $curl->response;

    //dd($user->vns_credentials);


    return $curl->response;
});