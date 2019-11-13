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

Route::get('/animals', 'AnimalsController@getAnimalsJSON')->middleware('auth:api');
Route::get('/reports', 'ReportsController@getReportJSON')->middleware('auth:api');
Route::patch('/users/{id}', 'UsersController@update')->middleware('auth:api');
Route::delete('/users/{id}', 'UsersController@destroy')->middleware('auth:api');
Route::patch('/settings/{id}', 'SettingsController@update')->middleware('auth:api');
