<?php
//language-----------------------------------------------------------------------------------------
Route::get("lang/{lang}", function($lang)
{
	$cookie = Cookie::forever('lang', $lang);
	(Session::get('redir_url'))? $url = Session::get('redir_url') : $url = "/";
	return Redirect::to($url)->withCookie($cookie);
});
//------------------------------------------------------------------------------------------------

//home---------------------------------------------------------------------------------------------
Route::get('/', 'HomeController@Index');
//-------------------------------------------------------------------------------------------------

//resourceful routes------------------------------------------------------------------------------
Route::resource('roles', 'RolesController');
Route::resource('users', 'UsersController');
Route::resource('pages', 'PagesController');
Route::resource('categories', 'CategoriesController');
Route::resource('categories.articles', 'ArticlesController');
Route::resource('articles.images'    , 'ImagesController');
//-------------------------------------------------------------------------------------------------

//admin--------------------------------------------------------------------------------------------
Route::get ('login',  'AdminController@Login');
Route::post('login',  'AdminController@pLogin');
Route::post('logout', 'AdminController@pLogout');
//------------------------------------------------------------------------------------------------

//API routes---------------------------------------------------------------------------------------------
Route::post('api/article/{id}/status', 'APIController@putArticleStatus');

Route::post('api/image/{id}/desc',   'APIController@putImageDesc');
Route::post('api/image/{id}/status', 'APIController@putImageStatus');
Route::post('api/image/{id}/main',   'APIController@putImageMain');
//------------------------------------------------------------------------------------------------
