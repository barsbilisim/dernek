<?php

class AdminController extends BaseController
{
	public function __construct()
	{
		$this->layout = 'layouts.simple';
		$this->beforeFilter('auth|csrf', ['on' => 'post']);
	}
	
	public function Login()
	{
		$this->layout->title   = 'Login';
		$this->layout->content = View::make('admin.login');
	}

	public function pLogin()
	{
		$validator = Validator::make(Input::all(), ['email'    => 'required|min:6|max:200|email', 'password' => 'required|min:5|max:100']);
		
		if ($validator->fails())
		return Redirect::to('/login')->withErrors($validator)->withInput();
		
		if(Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'active' => 1]))
		return Redirect::to("/");

		return Redirect::to('/login')->with('message', 'username or password incorrect')->withInput();
	}

	public function pLogout()
	{ 
		Auth::logout();
		return Redirect::to("/");
	}
	
}