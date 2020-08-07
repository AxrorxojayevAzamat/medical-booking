<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Auth::routes(['verify' => true]);

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth', 'can:admin-panel', 'can:admin-clinic-panel', 'can:manage-own-clinics'], function () {
    Route::get('', 'DashboardController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('specializations', 'SpecializationController');
    Route::resource('celebration', 'CelebrationController');
    Route::resource('partners', 'PartnerController');

    Route::get('/contactslist', 'DashboardController@contactsList')->name('contactlist');

    Route::resource('clinics', 'Clinic\ClinicController');
    Route::group(['prefix' => 'clinics/{clinic}', 'namespace' => 'Clinic', 'as' => 'clinics.'], function () {
        Route::resource('contacts', 'ContactController')->except('index');
        //MainPhoto
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
        // Services
        Route::group(['prefix' => 'services/{service}', 'as' => 'services.'], function () {
            Route::post('first', 'ServiceController@first')->name('first');
            Route::post('up', 'ServiceController@up')->name('up');
            Route::post('down', 'ServiceController@down')->name('down');
            Route::post('last', 'ServiceController@last')->name('last');
        });
    });

    Route::group(
        ['prefix' => 'users/{user}', 'as' => 'users.'],
        function () {
            Route::post('store-specializations', 'UserController@storeSpecializations')->name('store-specializations');
            Route::get('specializations', 'UserController@specializations')->name('specializations');
            Route::post('store-admin-clinics', 'UserController@storeAdminClinics')->name('store-admin-clinics');
            Route::get('admin-clinics', 'UserController@adminClinics')->name('admin-clinics');

            Route::post('store-clinics', 'UserController@storeClinics')->name('store-clinics');
            Route::get('user-clinics', 'UserController@userClinics')->name('user-clinics');
            //MainPhoto
            Route::get('main-photo', 'UserController@mainPhoto')->name('main-photo');
            Route::post('add-main-photo', 'UserController@addMainPhoto')->name('add-main-photo');
            Route::post('remove-main-photo', 'UserController@removeMainPhoto')->name('remove-main-photo');
            //Photos
            Route::get('photos', 'UserController@photos')->name('photos');
            Route::post('add-photo', 'UserController@addPhoto')->name('add-photo');
            Route::post('remove-photo/{photo}', 'UserController@removePhoto')->name('remove-photo');
            //Sorting
            Route::get('move-photo-up/{photo}', 'UserController@movePhotoUp')->name('move-photo-up');
            Route::get('remove-photo/{photo}', 'UserController@removePhoto')->name('delete-photo');
            Route::get('move-photo-down/{photo}', 'UserController@movePhotoDown')->name('move-photo-down');
        }
    );

    Route::resource('/regions', 'RegionController');
    Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
        Route::get('findCity/{id}', 'RegionController@findCity');
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

    Route::group(['prefix' => 'partners/{partner}', 'as' => 'partners.'], function () {
        Route::post('delete-photo', 'PartnerController@deletePhoto')->name('delete-photo');
        Route::post('first', 'PartnerController@first')->name('first');
        Route::post('up', 'PartnerController@up')->name('up');
        Route::post('down', 'PartnerController@down')->name('down');
        Route::post('last', 'PartnerController@last')->name('last');
    });

    Route::resource('services', 'Clinic\ServiceController');
    Route::group(['prefix' => 'services/{service}', 'as' => 'services.', 'namespace' => 'Clinic'], function () {
        Route::post('delete-image', 'ServiceController@removeImage')->name('delete-image');
        Route::post('characteristic/{characteristic}/first', 'ServiceController@first')->name('first');
        Route::post('characteristic/{characteristic}/up', 'ServiceController@up')->name('up');
        Route::post('characteristic/{characteristic}/down', 'ServiceController@down')->name('down');
        Route::post('characteristic/{characteristic}/last', 'ServiceController@last')->name('last');
    });

    Route::resource('news', 'NewsController');
    Route::group(['prefix' => 'news/{news}', 'as' => 'news.'], function () {
        Route::post('delete-image', 'NewsController@removeImage')->name('delete-image');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {
    Route::get('', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'book', 'namespace' => 'Book', 'as' => 'book.'], function () {

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
        Route::get('profile', 'DoctorController@profileShow')->name('profile');
        Route::get('{doctor_id}/bookings', 'DoctorController@books')->name('doctorbookings');
    });

    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::resource('/contacts', 'ContactsController');
        Route::get('', 'ContactsController@index')->name('contacts');
        Route::post('', 'ContactsController@contacts')->name('postContacts');
    });

    Route::group(['prefix' => 'doctors', 'as' => 'doctors.'], function () {
        Route::get('', 'Doctor\DoctorController@index')->name('index');
        Route::get('{user}', 'Doctor\DoctorController@show')->name('show');
        Route::get('{doctor_id}/rate/{rate}', 'RateController@rate')->name('rate');
        Route::get('{doctor_id}/ratecancel', 'RateController@rateCancel')->name('rateCancel');
        Route::get('{doctor}/clinics/{clinic}/book', 'Doctor\DoctorController@book')->name('book');

    });
    Route::get('/specializations', 'SpecializationsController@index')->name('specializations');

    Route::group(['as' => 'clinics.', 'prefix' => 'clinics'], function () {
        Route::get('', 'ClinicController@index')->name('index');
        Route::get('{clinic}', 'ClinicController@show')->name('show');
    });

    Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
        Route::get('', 'NewsController@index')->name('index');
        Route::get('{news}', 'NewsController@show')->name('show');
    });
});

Route::get("locale/{locale}", function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});

