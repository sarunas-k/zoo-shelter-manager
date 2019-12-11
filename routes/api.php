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

Route::get('/animals', 'AnimalsController@index')->middleware('auth:api');
Route::get('/reports', 'ReportsController@getReportJSON')->middleware('auth:api');
Route::patch('/users/{id}', 'UsersController@update')->middleware('auth:api');
Route::delete('/users/{id}', 'UsersController@destroy')->middleware('auth:api');
Route::patch('/staff/{id}', 'StaffController@update')->middleware('auth:api');
Route::delete('/staff/{id}', 'StaffController@destroy')->middleware('auth:api');
Route::patch('/settings/{id}', 'SettingsController@update')->middleware('auth:api');
Route::delete('/images/{id}', 'ImagesController@destroy')->middleware('auth:api');
