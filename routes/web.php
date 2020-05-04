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
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

//Маршруты для Клиник
Route::get('clinic/', 'Admin\ClinicController@index');
Route::get('clinic/', 'Admin\ClinicController@index')->name('clinic.index');
Route::get('clinic/show/{id}','Admin\ClinicController@show')->name('clinic.show');
Route::get('clinic/create', 'Admin\ClinicController@create')->name('clinic.create');
Route::post('clinic/', 'Admin\ClinicController@store')->name('clinic.store');
Route::get('clinic/edit/{id}', 'Admin\ClinicController@edit')->name('clinic.edit');
Route::patch('clinic/show/{id}', 'Admin\ClinicController@update')->name('clinic.update');
Route::delete('clinic/{id}', 'Admin\ClinicController@destroy')->name('clinic.destroy');

//Маршруты для Праздников
Route::get('celebration/', 'Admin\CelebrationController@index');
Route::get('celebration/', 'Admin\CelebrationController@index')->name('celebration.index');
Route::get('celebration/create', 'Admin\CelebrationController@create')->name('celebration.create');
Route::post('celebration/', 'Admin\CelebrationController@store')->name('celebration.store');
Route::get('celebration/edit/{id}', 'Admin\CelebrationController@edit')->name('celebration.edit');
Route::patch('celebration/show/{id}', 'Admin\CelebrationController@update')->name('celebration.update');
Route::delete('celebration/{id}', 'Admin\CelebrationController@destroy')->name('celebration.destroy');

//Маршруты для Регионов
Route::get('region/', 'Admin\RegionController@index');
Route::get('region/', 'Admin\RegionController@index')->name('region.index');
Route::get('region/create', 'Admin\RegionController@create')->name('region.create');
Route::get('region/createCity', 'Admin\RegionController@createCity')->name('region.createCity');
Route::get('region/createDistrict', 'Admin\RegionController@createDistrict')->name('region.createDistrict');
Route::get('region/findCity/{id}', 'Admin\RegionController@findCity');
Route::get('region/edit/{id}', 'Admin\RegionController@edit')->name('region.edit');
Route::get('region/editCity/{id}', 'Admin\RegionController@editCity')->name('region.editCity');
Route::get('region/editDistrict/{id}', 'Admin\RegionController@editDistrict')->name('region.editDistrict');
Route::post('region/', 'Admin\RegionController@store')->name('region.store');
Route::patch('region/show/{id}', 'Admin\RegionController@update')->name('region.update');
Route::delete('region/{id}', 'Admin\RegionController@destroy')->name('region.destroy');


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
        Route::post('users/{user}', 'UserController@specialization')->name('users.specialization');
        Route::post('users/{user}', 'UserController@clinic')->name('users.clinic');
        Route::get('users/{user}/additional', 'UserController@additional')->name('users.additional');
        Route::get('users/{user}/additionalForClinic', 'UserController@additionalForClinic')->name('users.additionalForClinic');
        Route::resource('specializations', 'SpecializationController');
        Route::resource('clinics', 'ClinicController');

    }
);
