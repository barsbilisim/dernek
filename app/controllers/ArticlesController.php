<?php

class ArticlesController extends BaseController
{

	/**
	 * Article Repository
	 *
	 * @var Article
	 */
	protected $category;
	protected $article;
	protected $artdetail;
	protected $artjoin;
	protected $lang;

	public function __construct(Article $article, ArticleDetail $artdetail, ArticleJoin $artjoin, Category $category)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get('app.locale');
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get'], 'except' => ['index', 'show']]);

		$this->beforeFilter(function()
		{
			if(Auth::check() && !Auth::user()->inRoles(['admin']))
				return Redirect::guest('login');
		}, ['except' => ['index', 'show']]);

		$this->category  = $category;
		$this->article   = $article;
		$this->artdetail = $artdetail;
		$this->artjoin   = $artjoin;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($cat)
	{
		$articles = $this->artjoin->orderBy('created_at', 'desc')->where('category', $cat)->where('lang', $this->lang)->get();

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.index', compact('articles', 'cat'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($cat)
	{
		$lang = ['kg' => trans('messages.kg'), 'tr' => trans('messages.tr')];

		$catid = 0;
		foreach ($this->category->all() as $c)
		{
			$category[$c->id] = trans('messages.'.$c->name);
			if($c->name == $cat) $catid = $c->id;
		}

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.create', compact('cat', 'lang', 'category', 'catid'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($cat)
	{
		$input = Input::all();
		$validation = Validator::make($input, ['title' => 'required', 'content' => 'required']);

		if ($validation->passes())
		{
			$id = uniqid();

			$this->article->create([
								'id'       => $id,
								'cat_id'   => Input::get('category', 1),
								'slider'   => Input::get('slider', 0),
								'anounce'  => Input::get('anounce', 0),
								'ended_at' => Input::get('alt_date').' '.date('23:59:59')]);

			$this->artdetail->create([
								'article_id' => $id,
								'user_id' => Auth::user()->id,
								'title'   => Input::get('title'),
								'content' => Input::get('content'),
								'desc'    => Input::get('desc'),
								'lang'    => Input::get('lang', $this->lang)]);

			

			return Redirect::route('categories.articles.index', [$this->category->find(Input::get('category', 1))->name]);
		}

		return Redirect::route('categories.articles.create', $cat)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($cat, $id)
	{
		$article = $this->artjoin->where('category', $cat)->where('lang', $this->lang)->where('id', $id)->first();

		if(count($article) == 0) 
			return Redirect::route('categories.articles.index', $cat);

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.show', compact('cat', 'article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($cat, $id)
	{
		$article = $this->artjoin->where('category', $cat)->where('lang', $this->lang)->where('id', $id)->first();
		
		foreach ($this->category->all() as $c)
		$category[$c->id] = trans('messages.'.$c->name);

		if (is_null($article))
		{
			return Redirect::route('categories.articles.index', $cat);
		}

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.edit', compact('article', 'cat', 'category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($cat, $id)
	{
		$input = Input::all();
		$validation = Validator::make($input, ['title' => 'required', 'content' => 'required']);

		if ($validation->passes())
		{
			$this->article->find($id)
							->update([
								'cat_id'   => Input::get('category', 1),
								'slider'   => Input::get('slider', 0),
								'anounce'  => Input::get('anounce', 0),
								'ended_at' => Input::get('alt_date').' '.date('23:59:59')]);

			$this->artdetail->where('article_id', $id)
							->where('lang', $this->lang)
							->update([
								'user_id' => Auth::user()->id,
								'title'   => Input::get('title'),
								'content' => Input::get('content'),
								'desc'    => Input::get('desc')]);

			return Redirect::route('categories.articles.show', [$this->category->find(Input::get('category', 1))->name, $id]);
		}

		return Redirect::route('categories.articles.edit', [$cat, $id])
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($cat, $id)
	{
		$this->article->find($id)->delete();

		return Redirect::route('categories.articles.index', $cat);
	}

}
