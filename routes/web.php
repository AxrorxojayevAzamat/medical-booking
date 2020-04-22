<?php
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;

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


Route::get('region/', 'RegionController@index');
Route::get('region/', 'RegionController@index')->name('region.index');
Route::get('region/create', 'RegionController@create')->name('region.create');
Route::get('region/createCity', 'RegionController@createCity')->name('region.createCity');
Route::get('region/createDistrict', 'RegionController@createDistrict')->name('region.createDistrict');
Route::get('region/findCity/{id}', 'RegionController@findCity');
Route::get('region/edit/{id}', 'RegionController@edit')->name('region.edit');
Route::post('region/', 'RegionController@store')->name('region.store');
Route::patch('region/show/{id}', 'RegionController@update')->name('region.update');
Route::delete('region/{id}', 'RegionController@destroy')->name('region.destroy');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group([ 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', 'Admin\UserController')
                             ->middleware('can:user-manage');
    Route::resource('specializations', 'Admin\SpecializationController')
                             ->middleware('can:user-manage');
});
