<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('', 'HomeController@index')->name('home');
Auth::routes(['verify' => true]);

Route::group(['prefix' => 'book', 'namespace' => 'Book', 'as' => 'book.'], function () {
    Route::get('', 'BookController@index')->name('index');
    Route::get('/show/{user}', 'BookController@show')->name('show');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel']], function () {
    Route::get('', 'DashboardController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('clinic', 'ClinicController');
    Route::resource('celebration', 'CelebrationController');

    Route::group(
        ['prefix' => 'users', 'as' => 'users.'],
        function () {
            Route::post('{user}/store-specializations', 'UserController@storeSpecializations')->name('store-specializations');
            Route::get('{user}/specializations', 'UserController@specializations')->name('specializations');

            Route::post('{user}/store-clinics', 'UserController@storeClinics')->name('store-clinics');
            Route::get('{user}/user-clinics', 'UserController@userClinics')->name('user-clinics');
        }
    );

    Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
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
    });


    Route::group(['prefix' => 'clinics/{clinic}', 'as' => 'clinic.'], function () {
        Route::get('main-photo', 'ClinicController@mainPhoto')->name('main-photo');
        Route::get('add-main-photo', 'ClinicController@addMainPhoto')->name('add-main-photo');
    });

    Route::group(
        ['prefix' => 'timetables/','as' => 'timetables.'],
        function () {
            Route::get('{user?}/{clinic?}/create', 'TimeTableController@create')->name('create');
            Route::post('store', 'TimeTableController@store')->name('store');
            Route::put('{user?}/{timetable?}/update', 'TimeTableController@update')->name('update');
            Route::get('{user?}/{clinic?}/edit', 'TimeTableController@edit')->name('edit');
            Route::delete('delete/{time?}', 'TimeTableController@destroy')->name('destroy');
        }
    );
    
    Route::group(['prefix' => 'books', 'as' => 'books.'], function () {
        Route::get('/', 'BookController@index')->name('index');
    });
    Route::group(['prefix' => 'call-center', 'as' => 'call-center.'], function () {
        Route::get('/', 'CallCenter\CallCenterController@index')->name('index');
        Route::get('/findCity1/{id}', 'CallCenter\CallCenterController@findCity1');

        Route::get('/findDoctor', 'CallCenter\CallCenterController@findDoctor');

        Route::get('/findDoctorByRegion', 'CallCenter\CallCenterController@findDoctorByRegion');
        Route::get('/findDoctorByType', 'CallCenter\CallCenterController@findDoctorByType');

        Route::get('/booking/{user}/{clinic}', 'CallCenter\CallCenterController@booking')->name('booking');
        Route::post('/booking/', 'CallCenter\CallCenterController@bookingDoctor')->name('bookingDoctor');

        Route::get('/booking-time/{user}/{clinic}', 'CallCenter\CallCenterController@bookingTime')->name('booking-time');
    });
});

Route::group(['as' => 'patient.', 'prefix' => 'patient', 'namespace' => 'Patient', 'middleware' => ['auth', 'can:patient-panel']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'DashboardController@profile_show')->name('profile');
});

Route::group(['as' => 'doctor.', 'prefix' => 'doctor', 'namespace' => 'Doctor', 'middleware' => ['auth', 'can:doctor-panel']], function () {
    Route::get('/', 'DoctorController@index')->name('dashboard');
    Route::get('/profile', 'DoctorController@profile_show')->name('profile');
});

Route::get("locale/{locale}", function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});
