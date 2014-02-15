<?php
//language----------------------------------------------------------------------------------------------
Route::get("lang/{lang}", function($lang)
{
	$cookie = Cookie::forever('lang', $lang);
	(Session::get('redir_url'))? $url = Session::get('redir_url') : $url = "/";
	return Redirect::to($url)->withCookie($cookie);
});
//------------------------------------------------------------------------------------------------------

//home--------------------------------------------------------------------------------------------------
Route::get('/', 'HomeController@Index');
//------------------------------------------------------------------------------------------------------

//resourceful routes------------------------------------------------------------------------------------
Route::resource('roles', 'RolesController');
Route::resource('users', 'UsersController');
Route::resource('pages', 'PagesController');
Route::resource('categories', 'CategoriesController');
Route::resource('categories.articles', 'ArticlesController');
Route::resource('articles.images'    , 'ImagesController');
Route::resource('sms', 'SmsController');
Route::resource('groups', 'GroupsController');
//--------------------------------------------------------------------------------------------------------

//admin routes--------------------------------------------------------------------------------------------
Route::get ('login'   , 'AdminController@Login');
Route::post('login'   , 'AdminController@pLogin');
Route::post('logout'  , 'AdminController@pLogout');
Route::get ('register', 'AdminController@Register');
Route::post('register', 'AdminController@pRegister');
Route::post('approve/{id}', 'AdminController@pApprove');
//--------------------------------------------------------------------------------------------------------

//API routes----------------------------------------------------------------------------------------------
Route::get ('api/article/list'       , 'APIController@getArticles');
Route::get ('api/article/loadmore'   , 'APIController@getLoadmore');
Route::post('api/article/{id}/status', 'APIController@putArticleStatus');
Route::post('api/article/{id}/delete', 'APIController@deleteArticle');

Route::post('api/image/{id}/desc'  , 'APIController@putImageDesc');
Route::post('api/image/{id}/status', 'APIController@putImageStatus');
Route::post('api/image/{id}/main'  , 'APIController@putImageMain');

Route::post('api/sms/{id}/delete', 'APIController@deleteSms');
Route::post('api/sms/send'       , 'APIController@sendSms');

Route::get ('api/user/list'       , 'APIController@getUsers');

Route::post('api/group/{gid}/user/{uid}/delete', 'APIController@deleteGroupUser');
Route::get ('api/group/{gid}'                  , 'APIController@getGroupUsers');

Route::post('api/role/{rid}/user/{uid}/delete', 'APIController@deleteRoleUser');
Route::get ('api/role/{rid}'                  , 'APIController@getRoleUsers');
//--------------------------------------------------------------------------------------------------------

Route::group(array('prefix' => 'panel'), function()
{
	Route::get('/', 'PanelController@Index');

	//panel API
	Route::get ('/api/payments/list'   , 'PanelController@listPayments');
	Route::post('/api/payments/update' , 'PanelController@updatePayments');
	Route::post('/api/payments/create' , 'PanelController@createPayments');
	Route::post('/api/payments/destroy', 'PanelController@destroyPayments');

	Route::get ('/api/payment/types/list', 'PanelController@listPaymentTypes');

	Route::get ('/api/user/list', 'PanelController@listUsers');

});