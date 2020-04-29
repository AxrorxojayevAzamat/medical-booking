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
    return view('welcome');
});

Route::get('region/', 'RegionController@index');
Route::get('region/', 'RegionController@index')->name('region.index');
Route::get('region/create', 'RegionController@create')->name('region.create');
Route::get('region/edit/{id}', 'RegionController@edit')->name('region.edit');
Route::post('region/', 'RegionController@store')->name('region.store');
Route::patch('region/show/{id}', 'RegionController@update')->name('region.update');
Route::delete('region/{id}', 'RegionController@destroy')->name('region.destroy');


Route::get('/test', function () {
    return view('test');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
//Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', 'Admin\UserController')
            ->middleware('can:user-manage');
    Route::resource('specializations', 'Admin\SpecializationController')
            ->middleware('can:user-manage');
    Route::post('/users/{user}', 'Admin\UserController@specialization')->name('users.specialization')
            ->middleware('can:user-manage');
    Route::get('/users/{user}/additional', 'Admin\UserController@additional')->name('users.additional')
            ->middleware('can:user-manage');
});


