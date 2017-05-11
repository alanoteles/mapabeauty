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

	Route::get('profile/busca_cep/{cep}','ProfileController@busca_cep');
	Route::any('/profile/uploadAnexo','ProfileController@uploadAnexo');
	Route::resource('profile', 'ProfileController'); //Using REST verbs
//	Route::any('/profile/teste','ProfileController@teste');

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


//Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware'=>['admin']], function () {

	//Página Inicial
	Route::get('admin/index', 'Admin\IndexController@index');

	// Login
	Route::get('admin/login', 'Admin\UsuariosController@showLogin');
	Route::post('admin/login', 'Admin\UsuariosController@doLogin');
	Route::get('admin/logout', 'Admin\UsuariosController@doLogout');
	//Route::get('/admin/logout', 'Auth\AuthController@logout');

	Route::get('admin/usuarios/nova_senha','Admin\UsuariosController@nova_senha');

//	Route::any('admin/profiles/uploadAnexo','Admin\ProfileController@uploadAnexo');
//	Route::any('admin/profiles/teste','Admin\ProfileController@teste');
	Route::resource('admin/profiles', 'Admin\ProfileController');

	//Serviços
	Route::get('admin/tabelas-de-apoio/services/pesquisa','Admin\ApoioServicesController@pesquisa');
	Route::resource('admin/tabelas-de-apoio/services', 'Admin\ApoioServicesController'); //Usando os verbos REST
	//Upload CKEditor
//	Route::post('/ckeditor-upload','Controller@ckeditor_upload');
//
//	//Projetos
//	Route::get('/projetos/retorna-traducao','ProjetosController@retorna_traducao');
//	Route::get('/projetos/pesquisa','ProjetosController@pesquisa');
//	Route::get('/projetos/destaques','ProjetosController@destaques');
//	Route::post('/projetos/destaques/salvar','ProjetosController@salva_destaques');
//	Route::resource('/projetos', 'ProjetosController'); //Usando os verbos REST
//
//	//Projetos em Números (admin)
//	Route::get('/projetos-em-numeros/retorna-traducao','ProjetosEmNumerosController@retorna_traducao');
//	Route::resource('/projetos-em-numeros', 'ProjetosEmNumerosController'); //Usando os verbos REST
//
//	Route::get('/secoes/retorna-traducao','SecoesController@retorna_traducao');
//	Route::get('/secoes/pesquisa','SecoesController@pesquisa');
//	Route::resource('/secoes', 'SecoesController'); //Usando os verbos REST
//
//	Route::get('/noticias/retorna-traducao','NoticiasController@retorna_traducao');
//	Route::get('/noticias/pesquisa','NoticiasController@pesquisa');
//	Route::get('/noticias/destaques','NoticiasController@destaques');
//	Route::post('/noticias/destaques/salvar','NoticiasController@salva_destaques');
//	Route::resource('/noticias', 'NoticiasController'); //Usando os verbos REST
//	//Objeto
//	Route::get('/objetos/retorna-traducao','ObjetosController@retorna_traducao');
//	Route::post('/objetos/uploadAnexo','ObjetosController@uploadAnexo');
//	Route::get('/objetos/pesquisa','ObjetosController@pesquisa');
//	Route::resource('/objetos', 'ObjetosController'); //Usando os verbos REST
//
//	Route::get('/parceiros/retorna-traducao','ParceirosController@retorna_traducao');
//	Route::get('/parceiros/pesquisa','ParceirosController@pesquisa');
//	Route::resource('/parceiros', 'ParceirosController'); //Usando os verbos REST
//
//	Route::get('/banners/retorna-traducao','BannersController@retorna_traducao');
//	Route::get('/banners/destaques','BannersController@destaques');
//	Route::post('/banners/destaques/salvar','BannersController@salva_destaques');
//	Route::get('/banners/pesquisa','BannersController@pesquisa');
//	Route::resource('/banners', 'BannersController'); //Usando os verbos REST
//
//	Route::get('/usuarios/nova_senha','UsuariosController@nova_senha');
//	Route::get('/usuarios/busca_cep','UsuariosController@busca_cep');
//	Route::get('/usuarios/pesquisa','UsuariosController@pesquisa');
//	Route::resource('/usuarios', 'UsuariosController'); //Usando os verbos REST
//
//	//--Tabelas de Apoio--//
//	//Index
	Route::get('admin/tabelas-de-apoio','Admin\TabelasDeApoioController@index');
//
//	//Idioma
//	Route::get('/tabelas-de-apoio/idioma/pesquisa','ApoioIdiomaController@pesquisa');
//	Route::resource('/tabelas-de-apoio/idioma', 'ApoioIdiomaController'); //Usando os verbos REST
//
//	//Escolaridade
//	Route::get('/tabelas-de-apoio/escolaridade/retorna-traducao','ApoioEscolaridadeController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/escolaridade/ordenacao','ApoioEscolaridadeController@ordenacao');
//	Route::get('/tabelas-de-apoio/escolaridade/pesquisa','ApoioEscolaridadeController@pesquisa');
//	Route::resource('/tabelas-de-apoio/escolaridade', 'ApoioEscolaridadeController'); //Usando os verbos REST
//
//	//Modalidade de Projeto
//	Route::get('/tabelas-de-apoio/modalidade-de-projeto/retorna-traducao','ApoioModalidadeDeProjetoController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/modalidade-de-projeto/pesquisa','ApoioModalidadeDeProjetoController@pesquisa');
//	Route::resource('/tabelas-de-apoio/modalidade-de-projeto', 'ApoioModalidadeDeProjetoController'); //Usando os verbos REST
//
//	//Atividade de Projeto
//	Route::get('/tabelas-de-apoio/atividade-de-projeto/retorna-traducao','ApoioAtividadeDeProjetoController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/atividade-de-projeto/pesquisa','ApoioAtividadeDeProjetoController@pesquisa');
//	Route::resource('/tabelas-de-apoio/atividade-de-projeto', 'ApoioAtividadeDeProjetoController'); //Usando os verbos REST
//
//	//Situação do Projeto
//	Route::get('/tabelas-de-apoio/situacao-do-projeto/retorna-traducao','ApoioSituacaoDoProjetoController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/situacao-do-projeto/pesquisa','ApoioSituacaoDoProjetoController@pesquisa');
//	Route::resource('/tabelas-de-apoio/situacao-do-projeto', 'ApoioSituacaoDoProjetoController'); //Usando os verbos REST
//


//
//	//Editoria da Notícia
////    Route::get('/tabelas-de-apoio/servicos/pesquisa','ApoioEditoriaDaNoticiaController@pesquisa');
////    Route::resource('/tabelas-de-apoio/servicos', 'ApoioEditoriaDaNoticiaController'); //Usando os verbos REST
//
//	//Grupo de Parceiros
//	Route::get('/tabelas-de-apoio/grupo-de-parceiros/retorna-traducao','ApoioGrupoDeParceirosController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/grupo-de-parceiros/pesquisa','ApoioGrupoDeParceirosController@pesquisa');
//	Route::resource('/tabelas-de-apoio/grupo-de-parceiros', 'ApoioGrupoDeParceirosController'); //Usando os verbos REST
//
//	//Tipo de Material
//	Route::get('/tabelas-de-apoio/tipo-de-material/retorna-traducao','ApoioTipoDeMaterialController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/tipo-de-material/pesquisa','ApoioTipoDeMaterialController@pesquisa');
//	Route::resource('/tabelas-de-apoio/tipo-de-material', 'ApoioTipoDeMaterialController'); //Usando os verbos REST
//
//	//Tipo de Mídia
//	Route::get('/tabelas-de-apoio/tipo-de-midia/retorna-traducao','ApoioTipoDeMidiaController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/tipo-de-midia/pesquisa','ApoioTipoDeMidiaController@pesquisa');
//	Route::resource('/tabelas-de-apoio/tipo-de-midia', 'ApoioTipoDeMidiaController'); //Usando os verbos REST
//
//	//Licenças
//	Route::get('/tabelas-de-apoio/licenca/retorna-traducao','ApoioLicencaController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/licenca/pesquisa','ApoioLicencaController@pesquisa');
//	Route::resource('/tabelas-de-apoio/licenca', 'ApoioLicencaController'); //Usando os verbos REST
//
//	//Tags
//	Route::get('/tabelas-de-apoio/tag/retorna-traducao','ApoioTagController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/tag/pesquisa','ApoioTagController@pesquisa');
//	Route::resource('/tabelas-de-apoio/tag', 'ApoioTagController'); //Usando os verbos REST
//
//	//Redes Sociais
//	Route::get('/tabelas-de-apoio/rede-social/retorna-traducao','ApoioRedeSocialController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/rede-social/pesquisa','ApoioRedeSocialController@pesquisa');
//	Route::resource('/tabelas-de-apoio/rede-social', 'ApoioRedeSocialController'); //Usando os verbos REST
//
//	//Níveis
//	Route::any('/tabelas-de-apoio/nivel/apaga-niveis','ApoioNivelController@apaga_niveis');
//	Route::any('/tabelas-de-apoio/nivel/adiciona-niveis','ApoioNivelController@adiciona_niveis');
//	Route::get('/tabelas-de-apoio/nivel/retorna-traducao','ApoioNivelController@retorna_traducao');
//	Route::get('/tabelas-de-apoio/nivel/retorna-traducao-nivel','ApoioNivelController@retorna_traducao_nivel');
//	Route::resource('/tabelas-de-apoio/nivel', 'ApoioNivelController'); //Usando os verbos REST

//});