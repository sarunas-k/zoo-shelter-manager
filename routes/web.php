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
Route::middleware(['web.common'])->group(function () {

    Route::middleware(['auth'])->group(function () {

        // HOME
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');

        // ANIMALS ROUTES
        Route::resource('animals', 'AnimalsController');

        // CALLS ROUTES
        Route::resource('calls', 'CallsController');

        // PROCEDURES ROUTES
        Route::resource('procedures', 'ProceduresController');
        Route::get('/procedures/create/{id}', 'ProceduresController@createWithAnimalID')->name('procedures.create.for.animal');

        // ADOPTIONS ROUTES
        Route::resource('adoptions', 'AdoptionsController');

        // FOSTERS ROUTES
        Route::resource('fosters', 'FostersController');

        // RECLAIMS ROUTES
        Route::resource('reclaims', 'ReclaimsController');

        // LIVING AREAS ROUTES
        Route::resource('living-areas', 'LivingAreasController');

        // PEOPLE ROUTES
        Route::resource('people', 'PeopleController');

        // REPORTS ROUTES
        Route::resource('reports', 'ReportsController')->only(['index', 'show']);

        // SEARCH
        Route::get('/search', 'SearchController@index');

        Route::middleware(['admin'])->group(function () {
            // SETTINGS
            Route::get('/settings', 'SettingsController@index')->name('settings');
             // USERS
            Route::resource('users', 'UsersController')->except(['index', 'show', 'edit']);
        });

    });
});


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
            ]);