<?php

class GroupsController extends BaseController
{

	/**
	 * Group Repository
	 *
	 * @var Group
	 */
	protected $group;
	protected $lang;

	public function __construct(Group $group)
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
		
		$this->group = $group;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = $this->group->all();

		$this->layout->title   = 'groups';
		$this->layout->content = View::make('groups.index', compact('groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->title   = 'Create group';
		$this->layout->content = View::make('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, ['name' => 'required|min:5|max:100']);

		if ($validation->passes())
		{
			$this->group->create($input);

			return Redirect::route('groups.index');
		}

		return Redirect::route('groups.create')
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
		$group = $this->group->findOrFail($id);

		$this->layout->title   = 'Group details';
		$this->layout->content = View::make('groups.show', compact('group'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = $this->group->find($id);

		if (is_null($group))
		{
			return Redirect::route('groups.index');
		}

		$this->layout->title   = 'Edit group';
		$this->layout->content = View::make('groups.edit', compact('group'));
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
			$group = $this->group->find($id)->update($input);

			return Redirect::route('groups.show', $id);
		}

		return Redirect::route('groups.edit', $id)
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
		$this->group->find($id)->delete();

		return Redirect::route('groups.index');
	}

}
