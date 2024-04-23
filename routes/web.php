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
        Route::resource('procedures', 'ProceduresController')->parameters(['procedures' => 'id']);
        Route::get('/procedures/create/{id}', 'ProceduresController@createWithAnimalID')->name('procedures.create.for.animal');

        // ADOPTIONS ROUTES
        Route::resource('adoptions', 'AdoptionsController');

        // FOSTERS ROUTES
        Route::resource('fosters', 'FostersController');

        // RECLAIMS ROUTES
        Route::resource('reclaims', 'ReclaimsController');

        // LIVING AREAS ROUTES
        Route::resource('living-areas', 'LivingAreasController')->parameters(['living-areas' => 'id']);

        // PEOPLE ROUTES
        Route::resource('people', 'PeopleController')->parameters(['people' => 'id']);

        // REPORTS ROUTES
        Route::resource('reports', 'ReportsController')->only(['index', 'show'])->parameters(['reports' => 'id']);

        // SEARCH
        Route::get('/search', 'SearchController@index');

        Route::middleware(['admin'])->group(function () {
            // SETTINGS
            Route::get('/settings', 'SettingsController@index')->name('settings');
            // USERS
            Route::resource('users', 'UsersController')->except(['index', 'show', 'edit'])->parameters(['users' => 'id']);
            // STAFF
            Route::resource('staff', 'StaffController')->only(['create', 'store'])->parameters(['staff' => 'id']);
        });

    });
});


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
            ]);