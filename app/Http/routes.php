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

// Route::group(['middleware' => ['web']], function () {

	//Route::get('/',                             ['as' => 'home',                        'uses' => 'IndexController@index']);

	Route::resource('/','IndexController');
	Route::get('/detail/{id?}','IndexController@show');
	Route::post('/search','IndexController@search');

	Route::auth();

	Route::get('/home', 'HomeController@index');

	Route::resource('user', 'UserController'); //Using REST verbs
	Route::post('user/email-validation' , ['as' => 'email-validation', 'uses' => 'UserController@emailValidation']);

	Route::get('profile-login/', 'ProfileController@index'); //Using REST verbs
	Route::resource('profile', 'ProfileController'); //Using REST verbs
	Route::get('profile/busca_cep/{cep}','ProfileController@busca_cep');
	Route::post('/profile/uploadAnexo','ProfileController@uploadAnexo');
	Route::post('/profile/cities','ProfileController@returnCities');
	Route::post('/profile/neighborhoods','ProfileController@returnNeighborhood');
	Route::post('/profile/search','ProfileController@search');
	Route::post('/profile/reviews','ProfileController@saveReview');




	Route::post('purchase/register-paypal', 'PurchaseController@registerPaypal');
	Route::get('purchase/returned-paypal/{tc}', 'PurchaseController@returnedPaypal');
	Route::post('purchase/register-pagseguro', 'PurchaseController@registerPagseguro');
	Route::any('purchase/returned-pagseguro/{tc?}', 'PurchaseController@returnedPagSeguro');
	Route::any('/notifications', 'PurchaseController@notificationsPagseguro');
	Route::any('/notification-pagseguro', 'PurchaseController@notificationsPagseguro');

	Route::resource('purchase', 'PurchaseController'); //Using REST verbs


	// OAuth Routes
	Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/contact',                  ['as' => 'contact',                'uses' => 'ContactController@index']);
    Route::post('/contact-send',            ['as' => 'contact-send',           'uses' => 'ContactController@send']);

    Route::get('/about', 'AboutUsController@index');
// });
