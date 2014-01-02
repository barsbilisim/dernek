<?php

class ImagesController extends BaseController
{

	/**
	 * Image Repository
	 *
	 * @var Image
	 */
	protected $image;
	protected $article;
	protected $lang;

	public function __construct(Article $article, Image $image)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('auth|csrf', ['on' => 'post', 'on' => 'put', 'on' => 'delete']);
		
		$this->image   = $image;
		$this->article = $article;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($art)
	{
		$images  = $this->image->where('article_id', $art)->get();
		$article = $this->article->find($art);

		$this->layout->title   = 'Images';
		$this->layout->content = View::make('images.index', compact('images', 'article'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($art)
	{
		$this->layout->title   = 'Create image';
		$this->layout->content = View::make('images.create', compact('art'));
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
			$this->image->create($input);

			return Redirect::route('images.index');
		}

		return Redirect::route('images.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($art, $id)
	{
		$image = $this->image->findOrFail($id);

		$this->layout->title   = 'Image details';
		$this->layout->content = View::make('images.show', compact('art', 'image'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($art, $id)
	{
		$image = $this->image->find($id);

		if (is_null($image))
		{
			return Redirect::route('images.index');
		}

		$this->layout->title   = 'Edit image';
		$this->layout->content = View::make('images.edit', compact('art', 'image'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($art, $id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, []);

		if ($validation->passes())
		{
			$image = $this->image->find($id)->update($input);

			return Redirect::route('images.show', $id);
		}

		return Redirect::route('images.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($art, $id)
	{
		$this->image->find($id)->delete();

		return Redirect::route('images.index');
	}

}
