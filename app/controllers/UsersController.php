<?php

class UsersController extends BaseController
{

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;
	protected $lang;

	public function __construct(User $user)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('auth|csrf', ['on' => 'post', 'on' => 'put']);

		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();

		$this->layout->title   = 'Users';
		$this->layout->content = View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->title   = 'Create';
		$this->layout->content = View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$validation = Validator::make($inputs, ['email' => 'required|email|unique:users,email|max:250', 'password' => 'required|alpha_num|max:100|min:5', 'balance' => 'numeric']);

		if ($validation->passes())
		{
			$inputs['id']       = uniqid();
			$inputs['password'] = Hash::make($inputs['password']);
			$this->user->create($inputs);

			return Redirect::route('users.show', $inputs['id']);
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);

		$this->layout->title   = 'User';
		$this->layout->content = View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}

		$this->layout->title   = 'Edit';
		$this->layout->content = View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputs = array_except(Input::all(), '_method');
		$validation = Validator::make($inputs, ['email' => 'required|email|unique:users,email,'.$id.'|max:250', 'password' => 'alpha_num|max:100|min:5', 'balance' => 'numeric']);

		if ($validation->passes())
		{
			if($inputs['password'] == "") unset($inputs['password']);
			else $inputs['password'] = Hash::make($inputs['password']);

			$user = $this->user->find($id)->update($inputs);

			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->user->find($id)->delete();

		return Redirect::route('users.index');
	}

}
