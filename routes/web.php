<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    return view('/test');
});



Route::get('/timetables/show', 'TimeTableController@show');
Route::get('/timetables/show', 'TimeTableController@show')->name('timetables.show');
Route::get('/timetables/create', 'TimeTableController@create')->name('timetables.create');
Route::get('/timetables/edit', 'TimeTableController@edit')->name('timetables.edit');
Route::post('/timetables/show', 'TimeTableController@store')->name('timetables.store');
Route::delete('/timetable/delete{id}', 'TimeTableController@destroy')->name('timetables.destroy');

Route::get('region/', 'RegionController@index');
Route::get('region/', 'RegionController@index')->name('region.index');
Route::get('region/create', 'RegionController@create')->name('region.create');
Route::get('region/edit/{id}', 'RegionController@edit')->name('region.edit');
Route::post('region/', 'RegionController@store')->name('region.store');
Route::patch('region/show/{id}', 'RegionController@update')->name('region.update');
Route::delete('region/{id}', 'RegionController@destroy')->name('region.destroy');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(
    [
        'middleware' => ['auth','can:user-manage'],
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
    ],
    function () {
        Route::resource('users', 'UserController');
        Route::post('/users/{user}', 'UserController@specialization')->name('users.specialization');
        Route::get('/users/{user}/additional', 'UserController@additional')->name('users.additional');
        Route::resource('specializations', 'SpecializationController');
    }
);
