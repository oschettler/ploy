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

Route::get('/', 'WelcomeController@index');
Route::post('/', 'WelcomeController@webhook');

Route::post('/repos/update/{id}', 'ReposController@update');

Route::get('/t', 'WelcomeController@t');

Route::get('home', 'HomeController@index');

Route::group([
    'prefix' => 'scripts',
    'middleware' => 'auth',
], function()
{
    // Display a listing of the resource.
    Route::get('', 'ScriptsController@index');

    // Show the form for creating a script
    Route::get('create', 'ScriptsController@create');

    // Store a newly created script in storage
    Route::post('store', [
        'as' => 'scripts.store',
        'uses' => 'ScriptsController@store'
    ]);

    // Show the form for editing the specified script
    Route::get('edit/{script}', 'ScriptsController@edit');

    // Update the specified script in storage
    Route::post('update/{script}', [
        'as' => 'scripts.update',
        'uses' => 'ScriptsController@update'
    ]);

    // Remove the specified script from storage
    Route::post('destroy/{script}', 'ScriptsController@destroy');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
