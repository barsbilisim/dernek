<?php

Route::get('/', function(){
	//$courses = Course::all();
	//return View::make('index', ['courses' => $courses, 'title' => 'Home']);
	return View::make('index', ['title' => 'Home']);
});

//language-----------------------------------------------------------------------------------------
Route::get("lang/{lang}", function($lang)
{
	$cookie = Cookie::forever('lang', $lang);
	(Session::get('redir_url'))? $url = Session::get('redir_url') : $url = "/";
	return Redirect::to($url)->withCookie($cookie);
});

//admin--------------------------------------------------------------------------------------------
Route::get ('login',  'AdminController@Login');
Route::post('login',  'AdminController@pLogin');
Route::post('logout', 'AdminController@pLogout');
//------------------------------------------------------------------------------------------------

Route::resource('users', 'UsersController');
Route::resource('pages', 'PagesController');
Route::resource('categories', 'CategoriesController');
Route::resource('categories.articles', 'ArticlesController');

//API---------------------------------------------------------------------------------------------
Route::get ('api/articles/{id}/status', 'APIController@getArticleStatus');
Route::post('api/articles/{id}/status', 'APIController@putArticleStatus');
//------------------------------------------------------------------------------------------------
