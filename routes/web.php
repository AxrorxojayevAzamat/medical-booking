<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
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
=======
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
//'prefix' => '{language}'
//Route::redirect('/', '/ru');

Route::group([], function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('doctors-list', function () {
        return view('doctors/list');
    });
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    });

    Auth::routes(['verify' => true]);

    Route::get('/admin', 'HomeController@index')->name('dahboard');
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
>>>>>>> 827f02aeffae83c4c602c03527d1a329d365dfe9
        }
    );

    Route::group(
<<<<<<< HEAD
        ['prefix' => 'clinics/{clinic}','as' => 'clinic.'],
        function () {
            Route::get('main-photo', 'ClinicController@mainPhoto')->name('main-photo');
            Route::get('add-main-photo', 'ClinicController@addMainPhoto')->name('add-main-photo');
        }
    );
    
    Route::get('callcenter/', 'CallCenter\CallCenterController@index')->name('admin.callcenter.index');
    Route::get('callcenter/findCity1/{id}', 'CallCenter\CallCenterController@findCity1');
    
    Route::get('callcenter/findDoctor', 'CallCenter\CallCenterController@findDoctor');
    
    Route::get('callcenter/findDoctorByRegion', 'CallCenter\CallCenterController@findDoctorByRegion');
    Route::get('callcenter/findDoctorByType', 'CallCenter\CallCenterController@findDoctorByType');
=======
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

    Route::get('/timetables/show', 'TimeTableController@show');
    Route::get('/timetables/show', 'TimeTableController@show')->name('timetables.show');
    Route::get('/timetables/create', 'TimeTableController@create')->name('timetables.create');
    Route::get('/timetables/edit', 'TimeTableController@edit')->name('timetables.edit');
    Route::post('/timetables/store', 'TimeTableController@store')->name('timetables.store');
    Route::delete('/timetable/delete{id}', 'TimeTableController@destroy')->name('timetables.destroy');
>>>>>>> 827f02aeffae83c4c602c03527d1a329d365dfe9
});
