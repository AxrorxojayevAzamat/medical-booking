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
    return view('/timetables/create');
});

Route::get('/time', 'TimeController@show');
Route::get('/time', 'TimeController@show')->name('time.show');
Route::get('/timetables/time', 'TimeController@store');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group([ 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', 'Admin\UserController')
        ->middleware('can:user-manage');



});
