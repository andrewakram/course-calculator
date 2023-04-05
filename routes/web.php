<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Web\HomeController;


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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('cache', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'success';
});

Route::get('/change-language/{lang}', function ($lang) {
    session()->put('lang', $lang);
    return back();
});


Route::group([
    'namespace' => 'App\Http\Controllers'
], function () {

    Route::group(['namespace' => 'Web', 'as' => 'web'], function () {
        Route::get('/', 'AuthController@login_view')->name('login-view');
        Route::post('login', 'AuthController@login')->name('.login');
        Route::get('logout', 'AuthController@logout')->name('.logout');

        Route::group(['middleware' => 'auth:web'], function () {
            Route::get('home', 'HomeController@index')->name('.home');

        });
        Route::group(['middleware' => 'auth:web'], function () {
            //ajax
            Route::get('/get/cities', 'HomeController@getCities')->name('.getCities');
            //ajax
            Route::get('/get/centers', 'HomeController@getCenters')->name('.getCenters');
            //ajax
            Route::get('/get/courses', 'HomeController@getCourses')->name('.getCourses');
            //ajax
            Route::get('/get/accomodations', 'HomeController@getAccomodations')->name('.getAccomodations');

            Route::post('/calculate/price', 'HomeController@calculatePrice')->name('.calculatePrice');
            Route::post('/print/calculate/price', 'HomeController@printCalculatePrice')->name('.printCalculatePrice');

        });
    });

});
