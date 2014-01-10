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
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(!User::inRoles(['admin', 'moder']))
				return Redirect::guest('login');
		});
		
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
	public function store($art)
	{
		static::globalXssClean();
		
		$input = Input::only('description');
		$validation = Validator::make($input, ['description' => 'alpha_num']);

		$crop = Input::get('coords');
		$file = (Input::get('dataUrl') == "")? file_get_contents(Input::get('srcUrl')): base64_decode(Input::get('dataUrl'));

		if ($validation->passes() && $crop != "" && $file != "")
		{
			$path = 'img/article/'.$art;
			if(!File::isDirectory($path)) File::makeDirectory($path);

			$crop   = json_decode($crop, true);	

			$orig   = imagecreatefromstring($file);
			$big    = ImageCreateTrueColor(1200, 800);
			$thumb  = ImageCreateTrueColor(300, 200);

			$b_path = $path.'/'.uniqid().'.jpg';
			imagecopyresampled($big, $orig, 0, 0, $crop['x'], $crop['y'], 1200, 800, $crop['w'], $crop['h']);
			imagejpeg($big, $b_path, 80);

			$t_path = $path.'/'.uniqid().'.jpg';
			imagecopyresampled($thumb, $big, 0, 0, 0, 0, 300, 200, 1200, 800);
			imagejpeg($thumb, $t_path, 40);

			imagedestroy($big); // release from memory
			imagedestroy($thumb); // release from memory

			$img = new Image;
			$img->id = uniqid();
			$img->article_id = $art;
			$img->big   = $b_path;
			$img->thumb = $t_path;
			$img[Config::get('app.locale')] = Input::get('description');
			$img->save();

			return Redirect::route('articles.images.index', $art);
		}

		return Redirect::route('articles.images.create', $art)
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
		static::globalXssClean();
		
		$input = Input::only('description');
		$validation = Validator::make($input, ['description' => 'alpha_num']);
		
		$crop = Input::get('coords');
		
		if ($validation->passes() && $crop != "")
		{
			$img  = Image::find($id);
			$img->update([Config::get('app.locale') => Input::get('description')]);

			$crop   = json_decode($crop, true);
			$orig   = imagecreatefromjpeg($img->big);
			$big    = ImageCreateTrueColor(1200, 800);
			$thumb  = ImageCreateTrueColor(300, 200);

			imagecopyresampled($big, $orig, 0, 0, $crop['x'], $crop['y'], 1200, 800, $crop['w'], $crop['h']);
			imagejpeg($big, $img->big, 80);

			imagecopyresampled($thumb, $big, 0, 0, 0, 0, 300, 200, 1200, 800);
			imagejpeg($thumb, $img->thumb, 40);

			imagedestroy($big); // release from memory
			imagedestroy($thumb); // release from memory

			return Redirect::route('articles.images.index', $art);
		}

		return Redirect::route('articles.images.edit', $art, $id)
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
		$img = $this->image->find($id);
		$img->forceDelete();

		if(File::isFile($img->big)) File::delete($img->big);
		if(File::isFile($img->thumb)) File::delete($img->thumb);

		return Redirect::route('articles.images.index', $art);
	}

}