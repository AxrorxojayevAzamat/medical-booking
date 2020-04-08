<?php
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

Route::get('/', 'RegionController@index');

//Route::resource('/post','PostController');

Route::get('region/','RegionController@index')->name('regions.index');
Route::get('region/create','RegionController@create')->name('regions.create');
Route::get('region/show/{id}','RegionController@show')->name('regions.show');
Route::get('region/edit/{id}','RegionController@edit')->name('regions.edit');
Route::post('region/','RegionController@store')->name('regions.store');
Route::patch('region/show/{id}','RegionController@update')->name('regions.update');
Route::delete('region/{id}','RegionController@destroy')->name('regions.destroy');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group([ 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::resource('users', 'Admin\UserController')->middleware('can:user-manage');

});
