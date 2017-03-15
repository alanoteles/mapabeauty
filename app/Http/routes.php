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

Route::group(['middleware' => ['web']], function () {

	Route::get('/',                             ['as' => 'home',                        'uses' => 'IndexController@index']);

	Route::auth();

	Route::get('/home', 'HomeController@index');


	Route::get('profile-login/', 'ProfileController@index'); //Using REST verbs
	Route::resource('profile/', 'ProfileController'); //Using REST verbs
	Route::get('profile/busca_cep/{cep}','ProfileController@busca_cep');
	Route::post('/profile/uploadAnexo','ProfileController@uploadAnexo');

	// OAuth Routes
	Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/contact',                  ['as' => 'contact',                'uses' => 'ContactController@index']);
    Route::post('/contact-send',            ['as' => 'contact-send',           'uses' => 'ContactcoController@send']);

    Route::get('/about', 'AboutUsController@index');
});
