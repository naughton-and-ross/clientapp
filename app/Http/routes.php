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
    return redirect('/dashboard');
});

Route::group(['prefix' => 'styles'], function() {
    Route::get('client', function() {
        return view('style');
    });
});

// Aplication routes...
Route::group(['middleware' => ['auth', 'log']], function() {
    Route::get('dashboard', 'DashboardController@renderDashboard');
    Route::resource('clients','ClientController');
    Route::resource('projects', 'ProjectController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('quotes', 'QuoteController');
});

Route::get('authme', function() {
    if (Auth::attempt(['email' => 'william.gravette@gmail.com', 'password' => 'password'])) {
        return redirect('/dashboard');
    }
});

Route::get('deauth', function() {
    Auth::logout();
    return redirect('/auth/login');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {
    Route::get('clients/{id}/projects', 'APIController@projectsByClient');
    Route::post('clients/{id}/projects', 'ProjectController@store');
    Route::post('clients/{id}/invoices', 'InvoiceController@store');
    Route::post('clients/{id}/quotes', 'QuoteController@store');
    Route::post('projects/{id}/updates', 'ProjectUpdateController@store');
    Route::post('projects/{id}/activity', 'ProjectActivityController@store');
    Route::post('return', 'APIController@returnReuqest');
    Route::get('test-email', 'APIController@testMailQueue');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('protected-resource', ['middleware' => 'oauth', function() {
    return "ya in";
}]);

Route::get('sms-test', function() {
    $message = SMS::send('0430113345', 'Test SMS');
});
