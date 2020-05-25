<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('admin', 'HomeController@index')->name('admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('clinic', 'ClinicController');
    Route::resource('celebration', 'CelebrationController');
    
    Route::group(
        [ 'prefix' => 'users', 'as' => 'users.' ],
        function () {
            Route::post('{user}/specialization', 'UserController@specialization')->name('specialization');
            Route::post('{user}/clinic', 'UserController@clinic')->name('clinic');
            Route::get('{user}/additional', 'UserController@additional')->name('additional');
            Route::get('{user}/additionalForClinic', 'UserController@additionalForClinic')->name('additionalForClinic');
        }
    );

    Route::group(
        ['prefix' => 'region', 'as' => 'region.'],
        function () {
            Route::get('/', 'RegionController@index')->name('index');
    
            Route::get('create', 'RegionController@create')->name('create');
            Route::get('createCity', 'RegionController@createCity')->name('createCity');
            Route::get('createDistrict', 'RegionController@createDistrict')->name('createDistrict');
            Route::get('findCity/{id}', 'RegionController@findCity');
    
            Route::get('edit/{id}', 'RegionController@edit')->name('edit');
            Route::get('editCity/{id}', 'RegionController@editCity')->name('editCity');
            Route::get('editDistrict/{id}', 'RegionController@editDistrict')->name('editDistrict');
    
            Route::post('/', 'RegionController@store')->name('store');
            Route::patch('show/{id}', 'RegionController@update')->name('update');
            Route::delete('{id}', 'RegionController@destroy')->name('destroy');
        }
    );

    Route::group(
        ['prefix' => 'clinics/{clinic}','as' => 'clinic.'],
        function () {
            Route::get('main-photo', 'ClinicController@mainPhoto')->name('main-photo');
            Route::get('add-main-photo', 'ClinicController@addMainPhoto')->name('add-main-photo');
        }
    );
    
    Route::get('callcenter/', 'CallCenter\CallCenterController@index')->name('admin.callcenter.index');
    Route::get('callcenter/findCity1/{id}', 'CallCenter\CallCenterController@findCity1');
    Route::get('callcenter/findClinicByType', 'CallCenter\CallCenterController@findClinicByType');

    Route::get('callcenter/findDoctor', 'CallCenter\CallCenterController@findDoctor');
    //Route::post('admin/callcenter/fetch', 'Admin\CallCenter\CallCenterController@index')->name('admin.callcenter.fetch');
});
