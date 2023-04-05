<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainAdmin\SettingController;


Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers'
], function () {

    Route::group(['namespace' => 'MainAdmin', 'as' => 'admin'], function () {
        Route::get('login', 'AuthController@login_view')->name('login-view');
        Route::post('login', 'AuthController@login')->name('.login');
        Route::get('logout', 'AuthController@logout')->name('.logout');

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('home', 'HomeController@index')->name('.home');
            Route::get('courses-last-7-days', 'HomeController@getDataCoursesLast7Days')
                ->name('.coursesLast7Days.datatable');
            Route::get('courses-exams-last-7-days', 'HomeController@getDataCoursesExamsLast7Days')
                ->name('.coursesExamsLast7Days.datatable');

        });
        Route::group(['middleware' => 'auth:admin'], function () {

            Route::group(['prefix' => 'countries', 'as' => '.countries'], function () {
                Route::get('/', 'CountryController@index');
                Route::get('getData', 'CountryController@getData')->name('.datatable');
                Route::get('/create', 'CountryController@create')->name('.create');
                Route::post('/store', 'CountryController@store')->name('.store');
                Route::get('/edit/{id}', 'CountryController@edit')->name('.edit');
                Route::post('/update', 'CountryController@update')->name('.update');
                Route::get('/show/{id}', 'CountryController@show')->name('.show');
                Route::post('/delete', 'CountryController@delete')->name('.delete');
                Route::post('/delete-multi', 'CountryController@deleteMulti')->name('.deleteMulti');
            });

            Route::group(['prefix' => 'cities', 'as' => '.cities'], function () {
                Route::get('/', 'CityController@index');
                Route::get('getData', 'CityController@getData')->name('.datatable');
                Route::get('/create', 'CityController@create')->name('.create');
                Route::post('/store', 'CityController@store')->name('.store');
                Route::get('/edit/{id}', 'CityController@edit')->name('.edit');
                Route::post('/update', 'CityController@update')->name('.update');
                Route::get('/show/{id}', 'CityController@show')->name('.show');
                Route::post('/delete', 'CityController@delete')->name('.delete');
                Route::post('/delete-multi', 'CityController@deleteMulti')->name('.deleteMulti');
            });

            Route::group(['prefix' => 'cities-courses', 'as' => '.cities-courses'], function () {
                Route::get('/', 'CityCourseController@index');
                Route::get('getData', 'CityCourseController@getData')->name('.datatable');
                Route::get('/create', 'CityCourseController@create')->name('.create');
                Route::post('/store', 'CityCourseController@store')->name('.store');
                Route::get('/edit/{id}', 'CityCourseController@edit')->name('.edit');
                Route::post('/update', 'CityCourseController@update')->name('.update');
                Route::get('/show/{id}', 'CityCourseController@show')->name('.show');
                Route::post('/delete', 'CityCourseController@delete')->name('.delete');
                Route::post('/delete-multi', 'CityCourseController@deleteMulti')->name('.deleteMulti');
                //ajax
                Route::get('/get/cities', 'CityCourseController@getCities')->name('.getCities');
            });

            Route::group(['prefix' => 'centers', 'as' => '.centers'], function () {
                Route::get('/', 'CenterController@index');
                Route::get('getData', 'CenterController@getData')->name('.datatable');
                Route::get('/create', 'CenterController@create')->name('.create');
                Route::post('/store', 'CenterController@store')->name('.store');
                Route::get('/edit/{id}', 'CenterController@edit')->name('.edit');
                Route::post('/update', 'CenterController@update')->name('.update');
                Route::get('/show/{id}', 'CenterController@show')->name('.show');
                Route::post('/delete', 'CenterController@delete')->name('.delete');
                Route::post('/delete-multi', 'CenterController@deleteMulti')->name('.deleteMulti');

            });

            Route::group(['prefix' => 'accomodations', 'as' => '.accomodations'], function () {
                Route::get('/', 'AccomodationController@index');
                Route::get('getData', 'AccomodationController@getData')->name('.datatable');
                Route::get('/create', 'AccomodationController@create')->name('.create');
                Route::post('/store', 'AccomodationController@store')->name('.store');
                Route::get('/edit/{id}', 'AccomodationController@edit')->name('.edit');
                Route::post('/update', 'AccomodationController@update')->name('.update');
                Route::get('/show/{id}', 'AccomodationController@show')->name('.show');
                Route::post('/delete', 'AccomodationController@delete')->name('.delete');
                Route::post('/delete-multi', 'AccomodationController@deleteMulti')->name('.deleteMulti');

            });

            Route::group(['prefix' => 'courses', 'as' => '.courses'], function () {
                Route::get('/', 'CourseController@index');
                Route::get('getData', 'CourseController@getData')->name('.datatable');
                Route::get('/create', 'CourseController@create')->name('.create');
                Route::post('/store', 'CourseController@store')->name('.store');
                Route::get('/edit/{id}', 'CourseController@edit')->name('.edit');
                Route::post('/update', 'CourseController@update')->name('.update');
                Route::get('/show/{id}', 'CourseController@show')->name('.show');
                Route::post('/delete', 'CourseController@delete')->name('.delete');
                Route::post('/delete-multi', 'CourseController@deleteMulti')->name('.deleteMulti');
            });


        });
    });

});
