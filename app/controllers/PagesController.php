<?php

class PagesController extends BaseController
{

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $page;
	protected $lang;

	public function __construct(Page $page)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get'], 'except' => ['index', 'show']]);

		$this->beforeFilter(function()
		{
			if(Auth::check() && !Auth::user()->inRoles(['admin']))
				return Redirect::guest('login');
		}, ['except' => ['index', 'show']]);
		
		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = $this->page->all();

		$this->layout->title   = 'Pages';
		$this->layout->content = View::make('pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$lang = ["kg" => trans("messages.kg"), "tr" => trans("messages.tr")];

		$this->layout->title   = 'Create page';
		$this->layout->content = View::make('pages.create', compact('lang'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$validation = Validator::make($inputs, ['name' => 'required', 'content' => 'required']);

		if ($validation->passes())
		{
			$page = $this->page->where('name', $inputs['name'])->where('lang', $inputs['lang'])->first();
			if($page)
			return Redirect::route('pages.edit', $page->id);

			$inputs['id'] = uniqid();
			$this->page->create($inputs);

			return Redirect::route('pages.show', $inputs['name']);
		}

		return Redirect::route('pages.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $name
	 * @return Response
	 */
	public function show($name)
	{
		$page = $this->page->where('lang', $this->lang)->where('name', $name)->first();

		if(!$page)
		$page = $this->page->where('lang', $this->lang)->where('name', '404')->first();

		$this->layout->title   = trans('messages.'.$name);
		$this->layout->content = View::make('pages.show', compact('page'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = $this->page->find($id);
		$lang = ["kg" => trans("messages.kg"), "tr" => trans("messages.tr")];

		if (is_null($page))
		{
			return Redirect::back();
		}

		$this->layout->title   = 'Edit';
		$this->layout->content = View::make('pages.edit', compact('page', 'lang'));
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
		$validation = Validator::make($input, ['name' => 'required', 'content' => 'required']);

		$page = $this->page->find($id);

		if ($validation->passes())
		{
			$page->update($input);

			return Redirect::route('pages.show', $page->name);
		}

		return Redirect::route('pages.edit', $page->id)
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
		$this->page->find($id)->delete();

		return Redirect::route('pages.index');
	}

}
