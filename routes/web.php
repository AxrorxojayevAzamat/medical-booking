<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('', 'HomeController@index')->name('home');
Auth::routes(['verify' => true]);

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel']], function () {
    Route::get('', 'DashboardController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('clinic', 'ClinicController');
    Route::resource('celebration', 'CelebrationController');

    Route::get('/contactslist', 'DashboardController@contactsList')->name('contactlist');


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


    Route::group(['prefix' => 'clinic', 'as' => 'clinic.'], function () {
        Route::get('{clinic}/main-photo', 'ClinicController@mainPhoto')->name('main-photo');
        Route::post('{clinic}/add-main-photo', 'ClinicController@addMainPhoto')->name('add-main-photo');
        Route::post('{clinic}/remove-main-photo', 'ClinicController@removeMainPhoto')->name('remove-main-photo');
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

    Route::resource('news', 'NewsController');
});

Route::group(['prefix' => 'book', 'namespace' => 'Book', 'as' => 'book.'], function () {
    Route::get('', 'BookController@index')->name('index');
    Route::get('/{user}', 'BookController@show')->name('show');
    Route::get('/{doctor_id}/rate/{rate}', 'BookController@rate')->name('rate');
    Route::get('/{doctor_id}/ratecancel', 'BookController@rateCancel')->name('rateCancel');
    Route::get('/review', 'BookController@review')->name('reviews');

    Route::post('paycom/create', 'PaycomController@createOrder');
    Route::post('paycom/perform', 'PaycomController@performOrder');

    Route::post('click/create', 'ClickController@createOrder');
    Route::post('click/create-token', 'ClickController@createToken');
    Route::post('click/verify-token', 'ClickController@verifyToken');
    Route::post('click/perform', 'ClickController@performOrder');
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

Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::resource('/contacts', 'ContactsController');
        Route::get('', 'ContactsController@index')->name('contacts');
        Route::post('', 'ContactsController@contacts')->name('postContacts');
});

Route::get('/specializations', 'SpecializationsController@index')->name('specializations');

Route::get("locale/{locale}", function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});
