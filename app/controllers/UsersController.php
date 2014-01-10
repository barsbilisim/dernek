<?php

class UsersController extends BaseController
{

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;
	protected $role;
	protected $lang;

	public function __construct(User $user, Role $role)
	{
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(!User::inRoles(['admin']))
				return Redirect::guest('login');
		});
		
		$this->user = $user;
		$this->role = $role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->withTrashed()->get();

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
		$roles = $this->role->all();

		$this->layout->title   = 'Create';
		$this->layout->content = View::make('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input,
					['email'   => 'required|email|unique:users,email|max:250',
					'password' => 'required|alpha_num|max:100|min:5',
					'balance'  => 'numeric',
					'phone'    => 'numeric']);

		if ($validation->passes())
		{
			$id = uniqid();
			$this->user->create(
				['id'      => $id,
				'email'    => $input['email'],
				'password' => Hash::make($input['password']),
				'balance'  => $input['balance'],
				'phone'    => $input['phone']
				]);

			foreach ($this->role->all() as $role)
			{
				if(in_array($role->name, Input::get('roles',[])))
				$role->users()->attach($id);
			}

			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->withTrashed()->findOrFail($id);

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
		$user  = $this->user->withTrashed()->find($id);
		$roles = $this->role->all();

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}

		$this->layout->title   = 'Edit';
		$this->layout->content = View::make('users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input,
					['email'   => 'required|email|unique:users,email,'.$id.'|max:250',
					'password' => 'alpha_num|max:100|min:5',
					'balance'  => 'numeric',
					'phone'    => 'numeric']);

		if ($validation->passes())
		{
			$user = $this->user->withTrashed()->find($id);
			$user->email    = $input['email'];
			if($input['password'] != "")
				$user->password = Hash::make($input['password']);
			$user->balance  = $input['balance'];
			$user->phone    = $input['phone'];
			$user->deleted_at = (Input::get('deleted') == 1)?date('Y-m-d H:t:s'):null;
			$user->save();

			foreach ($this->role->all() as $role)
			{
				$user->roles()->detach($role->id);
				if(in_array($role->name, Input::get('roles',[])))
				$user->roles()->attach($role->id);
			}

			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->id != $id)
		{
			$user = $this->user->withTrashed()->find($id);
			($user->deleted_at == null)?$user->delete():$user->forceDelete();
		}

		return Redirect::route('users.index');
	}

}
