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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/callcenter/', 'Admin\CallCenter\CallCenterController@index')->name('admin.callcenter.index');
//Route::post('admin/callcenter/fetch', 'Admin\CallCenter\CallCenterController@index')->name('admin.callcenter.fetch');

Route::group(
        [
            'middleware' => ['auth', 'can:user-manage'],
            'prefix' => 'admin',
            'namespace' => 'Admin',
            'as' => 'admin.',
        ],
        function () {
    Route::resource('users', 'UserController');
    Route::post('users/{user}/specialization', 'UserController@specialization')->name('users.specialization');
    Route::post('users/{user}/clinic', 'UserController@clinic')->name('users.clinic');
    Route::get('users/{user}/additional', 'UserController@additional')->name('users.additional');
    Route::get('users/{user}/additionalForClinic', 'UserController@additionalForClinic')->name('users.additionalForClinic');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('clinics', 'ClinicController');
}
);

Route::group(
        [
            'middleware' => ['auth'],
            'namespace' => 'Admin',
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        function () {
    Route::get('celebration/', 'CelebrationController@index');
    Route::get('celebration/', 'CelebrationController@index')->name('celebration.index');
    Route::get('celebration/create', 'CelebrationController@create')->name('celebration.create');
    Route::post('celebration/', 'CelebrationController@store')->name('celebration.store');
    Route::get('celebration/edit/{id}', 'CelebrationController@edit')->name('celebration.edit');
    Route::patch('celebration/show/{id}', 'CelebrationController@update')->name('celebration.update');
    Route::delete('celebration/{id}', 'CelebrationController@destroy')->name('celebration.destroy');
}
);

Route::group(
        [
            'middleware' => ['auth'],
            'namespace' => 'Admin',
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        function () {
    Route::get('region/', 'RegionController@index');
    Route::get('region/', 'RegionController@index')->name('region.index');
    Route::get('region/create', 'RegionController@create')->name('region.create');
    Route::get('region/createCity', 'RegionController@createCity')->name('region.createCity');
    Route::get('region/createDistrict', 'RegionController@createDistrict')->name('region.createDistrict');
    Route::get('region/findCity/{id}', 'RegionController@findCity');
    Route::get('region/edit/{id}', 'RegionController@edit')->name('region.edit');
    Route::get('region/editCity/{id}', 'RegionController@editCity')->name('region.editCity');
    Route::get('region/editDistrict/{id}', 'RegionController@editDistrict')->name('region.editDistrict');
    Route::post('region/', 'RegionController@store')->name('region.store');
    Route::patch('region/show/{id}', 'RegionController@update')->name('region.update');
    Route::delete('region/{id}', 'RegionController@destroy')->name('region.destroy');
}
);

Route::group(
        [
            'middleware' => ['auth'],
            'namespace' => 'Admin',
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        function () {
    Route::get('clinic/', 'ClinicController@index');
    Route::get('clinic/', 'ClinicController@index')->name('clinic.index');
    Route::get('clinic/show/{id}', 'ClinicController@show')->name('clinic.show');
    Route::get('clinic/create', 'ClinicController@create')->name('clinic.create');
    Route::post('clinic/', 'ClinicController@store')->name('clinic.store');
    Route::get('clinic/edit/{id}', 'ClinicController@edit')->name('clinic.edit');
    Route::patch('clinic/show/{id}', 'ClinicController@update')->name('clinic.update');
    Route::delete('clinic/{id}', 'ClinicController@destroy')->name('clinic.destroy');
}
);

Route::get('admin/callcenter/findCity1/{id}', 'Admin\CallCenter\CallCenterController@findCity1');
Route::get('admin/callcenter/findClinicByType/{id}', 'Admin\CallCenter\CallCenterController@findClinicByType');
