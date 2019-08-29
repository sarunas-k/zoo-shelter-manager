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

Route::get('/', 'HomeController@index')->middleware('auth');

// ANIMALS ROUTES
Route::resource('animals', 'AnimalsController')->middleware('auth');

// CALLS ROUTES
Route::resource('calls', 'CallsController')->middleware('auth');

// PROCEDURES ROUTES
Route::resource('procedures', 'ProceduresController')->middleware('auth');
Route::get('/procedures/create/{id}', 'ProceduresController@createWithAnimalID')->middleware('auth')->name('procedures.create.for.animal');

// ADOPTIONS ROUTES
Route::resource('adoptions', 'AdoptionsController')->middleware('auth');
Route::get('/adoptions/create/{id}', 'AdoptionsController@createWithAnimalID')->middleware('auth')->name('adoptions.create.for.animal');

// FOSTERS ROUTES
Route::resource('fosters', 'FostersController')->middleware('auth');
Route::get('/fosters/create/{id}', 'FostersController@createWithAnimalID')->middleware('auth')->name('fosters.create.for.animal');

// RECLAIMS ROUTES
Route::resource('reclaims', 'ReclaimsController')->middleware('auth');
Route::get('/reclaims/create/{id}', 'ReclaimsController@createWithAnimalID')->middleware('auth')->name('reclaims.create.for.animal');

// LIVING AREAS ROUTES
Route::resource('living-areas', 'LivingAreasController')->middleware('auth');

// PEOPLE ROUTES
Route::resource('people', 'PeopleController')->middleware('auth');


Route::get('/search', 'SearchController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

