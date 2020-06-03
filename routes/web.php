<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//'prefix' => '{language}'
//Route::redirect('/', '/ru');
Route::get('/', 'HomeController@index')->name('home');


Auth::routes(['verify' => true]);
//Route::get('admin', 'HomeController@index')->name('admin');

Route::get('doctors-list', function () {
    return view('doctors/list');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('clinic', 'ClinicController');
    Route::resource('celebration', 'CelebrationController');
    
    Route::group(
        [ 'prefix' => 'users', 'as' => 'users.' ],
        function () {
            Route::post('{user}/store-specializations', 'UserController@storeSpecializations')->name('store-specializations');
            Route::get('{user}/specializations', 'UserController@specializations')->name('specializations');
            
            Route::post('{user}/store-clinics', 'UserController@storeClinics')->name('store-clinics');
            Route::get('{user}/user-clinics', 'UserController@userClinics')->name('user-clinics');
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
    
            Route::get('edit/{region}', 'RegionController@edit')->name('edit');
            Route::get('editCity/{region}', 'RegionController@editCity')->name('editCity');
            Route::get('editDistrict/{region}', 'RegionController@editDistrict')->name('editDistrict');
    
            Route::post('/', 'RegionController@store')->name('store');
            Route::patch('show/{region}', 'RegionController@update')->name('update');
            Route::delete('{region}', 'RegionController@destroy')->name('destroy');
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
    
    Route::get('callcenter/findDoctor', 'CallCenter\CallCenterController@findDoctor');
    
    Route::get('callcenter/findDoctorByRegion', 'CallCenter\CallCenterController@findDoctorByRegion');
    Route::get('callcenter/findDoctorByType', 'CallCenter\CallCenterController@findDoctorByType');
       
    Route::get('/timetables/show', 'TimeTableController@show');
    Route::get('/timetables/show', 'TimeTableController@show')->name('timetables.show');
    Route::get('/timetables/create', 'TimeTableController@create')->name('timetables.create');
    Route::get('/timetables/edit', 'TimeTableController@edit')->name('timetables.edit');
    Route::post('/timetables/store', 'TimeTableController@store')->name('timetables.store');
    Route::delete('/timetable/delete{id}', 'TimeTableController@destroy')->name('timetables.destroy');
});
