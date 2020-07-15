<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('', 'HomeController@index')->name('home');
Auth::routes(['verify' => true]);

Route::group(['prefix' => 'book', 'namespace' => 'Book', 'as' => 'book.'], function () {
    Route::get('', 'BookController@index')->name('index');
    Route::get('/show/{user}', 'BookController@show')->name('show');
    Route::get('/review', 'BookController@review')->name('reviews');
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

    Route::resource('/regions', 'RegionController');
    Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
        Route::get('findCity/{id}', 'RegionController@findCity');
    });


    Route::group(['prefix' => 'clinic/{clinic}', 'as' => 'clinic.'], function () {
        Route::get('main-photo', 'ClinicController@mainPhoto')->name('main-photo');
        Route::post('add-main-photo', 'ClinicController@addMainPhoto')->name('add-main-photo');
        Route::post('remove-main-photo', 'ClinicController@removeMainPhoto')->name('remove-main-photo');
        //Photos
        Route::get('photos', 'ClinicController@photos')->name('photos');
        Route::post('add-photo', 'ClinicController@addPhoto')->name('add-photo');
        Route::post('remove-photo/{photo}', 'ClinicController@removePhoto')->name('remove-photo');
        //Sorting
        Route::get('move-photo-up/{photo}', 'ClinicController@movePhotoUp')->name('move-photo-up');
        Route::get('remove-photo/{photo}', 'ClinicController@removePhoto')->name('delete-photo');
        Route::get('move-photo-down/{photo}', 'ClinicController@movePhotoDown')->name('move-photo-down');
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
    Route::group(['prefix' => 'call-center', 'namespace' => 'CallCenter','as' => 'call-center.'], function () {
        Route::get('/findDoctorByRegion', 'CallCenterController@findDoctorByRegion');
        Route::get('/findDoctorByType', 'CallCenterController@findDoctorByType');
        
        Route::get('/', 'CallCenterController@index')->name('index');
        Route::get('/create-patient', 'CallCenterController@create')->name('create-patient');
        Route::post('/store-patient', 'CallCenterController@storePatient')->name('store-patient');
        Route::get('patient/{user}/doctor', 'CallCenterController@doctors')->name('patient-doctor');
        Route::get('/patient/{user}/doctor/{doctor}', 'CallCenterController@show')->name('show-doctor');
        Route::post('/booking-doctor', 'CallCenterController@bookingDoctor')->name('booking-doctor');
    });
});

Route::group(['as' => 'patient.', 'prefix' => 'patient', 'namespace' => 'Patient', 'middleware' => ['auth', 'can:patient-panel']], function () {
    Route::get('', 'PatientController@profileShow')->name('profile');
    Route::get('/booking/{user}/{clinic}', 'PatientController@booking')->name('booking');
    Route::post('/booking-doctor/', 'PatientController@bookingDoctor')->name('booking-doctor');
    Route::get('/{user_id}/bookings', 'PatientController@myBookings')->name('mybookings');
});

Route::group(['as' => 'doctor.', 'prefix' => 'doctor', 'namespace' => 'Doctor', 'middleware' => ['auth', 'can:doctor-panel']], function () {
    Route::get('', 'DoctorController@profileShow')->name('profile');
    Route::get('/{doctor_id}/bookings', 'DoctorController@doctorBookings')->name('doctorbookings');
});

Route::get("locale/{locale}", function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});
