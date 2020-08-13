<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('regions/children/{parent_id}', 'Api\RegionController@children');
Route::get('call-center/findDoctorByRegion', 'Api\CallCenterController@findDoctorByRegion');
Route::get('call-center/findDoctorByType', 'Api\CallCenterController@findDoctorByType');

Route::post('book/paycom', ['uses' => 'Book\PaycomController@endpoint']);
Route::post('book/click/prepare', ['uses' => 'Book\ClickController@prepare']);
Route::post('book/click/complete', ['uses' => 'Book\ClickController@complete']);

//Route::post('book/paycom/create', 'Book\PaycomController@createOrder');
//Route::post('book/paycom/perform', 'Book\PaycomController@performOrder');
//Route::post('book/click/create', 'Book\ClickController@createOrder');
//Route::post('book/click/create-token', 'Book\ClickController@createOrder');
//Route::post('book/click/verify-token', 'Book\ClickController@createOrder');
//Route::post('book/click/perform', 'Book\ClickController@performOrder');
