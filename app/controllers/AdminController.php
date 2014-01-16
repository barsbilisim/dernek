<?php

class AdminController extends BaseController
{
	protected $user;
	public function __construct(User $user)
	{
		$this->beforeFilter('csrf', ['on' => 'post']);
		$this->beforeFilter('auth', ['on' => 'post', 'except' => ['pLogin', 'pRegister']]);

		$this->layout = 'layouts.simple';
		$this->user   = $user;
	}
	
	public function Login()
	{
		$this->layout->title   = 'Login';
		$this->layout->content = View::make('admin.login');
	}

	public function pLogin()
	{
		$validator = Validator::make(Input::all(),
			['email'   => 'required|min:6|max:200|email',
			'password' => 'required|min:5|max:100']);
		
		if ($validator->fails())
		return Redirect::to('login')->withErrors($validator)->withInput();
		
		if(Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'active' => 1]))
		return Redirect::to("/");

		return Redirect::to('login')->with('message', 'username or password incorrect')->withInput();
	}

	public function pLogout()
	{ 
		Auth::logout();
		return Redirect::to("/");
	}

	public function Register()
	{
		$this->layout->title   = 'Register';
		$this->layout->content = View::make('admin.register');
	}
	
	public function pRegister()
	{
		static::globalXssClean();			

			$input = Input::all();
			$validation = Validator::make($input,
						[
						'email'      => 'required|email|unique:users,email|max:250',
						'phone'      => 'numeric',
						'firstname'  => 'required|max:100',
						'lastname'   => 'required|max:100',
						'birth_date'     => 'required|max:100',
						'marital_status' => 'required|max:100'
						]);

		if ($validation->passes())
		{
			$id    = uniqid();
			$pass  = static::generatePassword();
			
			$user  = new User;

			$user->id         = $id;
			$user->active     = 2;
			$user->email      = $input['email'];
			$user->phone      = $input['phone'];
			$user->firstname  = $input['firstname'];
			$user->lastname   = $input['lastname'];
			$user->passport   = $input['passport'];
			$user->occupation = $input['occupation'];
			$user->company    = $input['company'];
			$user->birth_date = $input['birth_date'];
			$user->bachelor   = $input['bachelor'];
			$user->master     = $input['master'];
			$user->phd        = $input['phd'];
			$user->marital_status = $input['marital_status'];
			
			$user->save();

			return Redirect::to('register')->withSuccess(trans("messages.your-dernek-application-waiting-approval"));
		}

		return Redirect::to('register')->withErrors($validator)->withInput();
	}

	public function pApprove($id)
	{
		$pass  = static::generatePassword();
		$user = $this->user->find($id);
		$user->update(['active' => 1, 'password' => Hash::make($pass)]);

		$email = $user->email;

		// Mail::send('emails.auth.userapprove', ["password" => $pass, "email" => $email], function($message) use($email) {
		// 	$message->to($email)->subject('Account approved');
		// });

		return Redirect::route('users.index');
	}
}