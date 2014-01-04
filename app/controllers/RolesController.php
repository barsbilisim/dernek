<?php

class RolesController extends BaseController
{

	/**
	 * Role Repository
	 *
	 * @var Role
	 */
	protected $role;
	protected $lang;

	public function __construct(Role $role)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(Auth::check() && !Auth::user()->inRoles(['admin']))
				return Redirect::guest('login');
		});
		
		$this->role = $role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = $this->role->all();

		$this->layout->title   = 'roles';
		$this->layout->content = View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->title   = 'Create role';
		$this->layout->content = View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, []);

		if ($validation->passes())
		{
			$this->role->create($input);

			return Redirect::route('roles.index');
		}

		return Redirect::route('roles.create')
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
		$role = $this->role->findOrFail($id);

		$this->layout->title   = 'Role details';
		$this->layout->content = View::make('roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = $this->role->find($id);

		if (is_null($role))
		{
			return Redirect::route('roles.index');
		}

		$this->layout->title   = 'Edit role';
		$this->layout->content = View::make('roles.edit', compact('role'));
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
		$validation = Validator::make($input, []);

		if ($validation->passes())
		{
			$role = $this->role->find($id)->update($input);

			return Redirect::route('roles.show', $id);
		}

		return Redirect::route('roles.edit', $id)
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
		$this->role->find($id)->delete();

		return Redirect::route('roles.index');
	}

}
