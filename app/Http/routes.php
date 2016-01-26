<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('styles/client');
});

Route::group(['prefix' => 'styles'], function() {
    Route::get('client', function() {
        return view('style');
    });
});

// Aplication routes...
Route::resource('clients','ClientController');
Route::resource('projects', 'ProjectController');
Route::resource('invoices', 'InvoiceController');
Route::resource('quotes', 'QuoteController');

Route::get('authme', function() {
    if (Auth::attempt(['email' => 'william.gravette@gmail.com', 'password' => 'password'])) {
        return redirect('/');
    }
});


Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {
    Route::get('clients/{id}/projects', 'APIController@projectsByClient');
    Route::post('clients/{id}/projects', 'ProjectController@store');
    Route::post('clients/{id}/invoices', 'InvoiceController@store');
    Route::post('clients/{id}/quotes', 'QuoteController@store');
    Route::post('projects/{id}/updates', 'ProjectUpdateController@store');
    Route::post('return', 'APIController@returnReuqest');
});
