<?php

class CategoriesController extends BaseController
{
	/**
	 * Category Repository
	 *
	 * @var Category
	 */
	protected $category;
	protected $lang;

	public function __construct(Category $category)
	{
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get('app.locale');
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(!User::inRoles(['admin']))
				return Redirect::guest('login');
		});
		
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->category->withTrashed()->get();

		$this->layout->title   = 'Categories';
		$this->layout->content = View::make('categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->title   = 'Create';
		$this->layout->content = View::make('categories.create');
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
			$id = uniqid();
			$this->category->create([
				'id'   => $id,
				'name' => $input['name']]);

			return Redirect::route('categories.index');
		}

		return Redirect::route('categories.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $name
	 * @return Response
	 */
	public function show($name)
	{
		$category = $this->category->withTrashed()->where('name', $name)->firstOrFail();

		$this->layout->title   = trans('messages.'.$name);
		$this->layout->content = View::make('categories.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = $this->category->withTrashed()->find($id);

		if (is_null($category))
		{
			return Redirect::to('/');
		}

		$this->layout->title   = 'Edit category';
		$this->layout->content = View::make('categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$validation = Validator::make($input, ['name' => 'required|min:5|max:100']);

		if ($validation->passes())
		{
			$cat = $this->category->withTrashed()->find($id);
			$cat->name = $input['name'];
			$cat->deleted_at = (Input::get('deleted') == 1)?date('Y-m-d H:t:s'):null;
			$cat->save();

			return Redirect::route('categories.index');
		}

		return Redirect::route('categories.edit', $id)
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
		$cat = $this->category->withTrashed()->find($id);
		($cat->deleted_at == null)?$cat->delete():$cat->forceDelete();

		return Redirect::route('categories.index');
	}

}
