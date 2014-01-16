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
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get('app.locale');
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get'], 'except' => ['index', 'show']]);

		$this->beforeFilter(function()
		{
			if(!User::inRoles(['admin', 'moder']))
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
		$articles = $this->artjoin->orderBy('created_at', 'desc')->where('category', $cat)->where('lang', $this->lang)->paginate(6);

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

		foreach ($this->category->all() as $c)
		{
			$category[$c->name] = trans('messages.'.$c->name);
		}

		$cd = new Datetime();
		$create_date = $cd->format('j').' '.static::localMonth($cd->format('F')).' '.$cd->format('Y');

		$ed = new Datetime();
		$ed->add(new DateInterval('P30D'));
		$end_date = $ed->format('j').' '.static::localMonth($ed->format('F')).' '.$ed->format('Y');

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.create', compact('cat', 'lang', 'category', 'create_date', 'end_date', 'cd', 'ed'));
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

			$c = $this->category->where('name', Input::get('category', 'news'))->first();

			$this->article->create([
								'id'         => $id,
								'cat_id'     => $c->id,
								'created_at' => Input::get('create_alt').' '.date('H:t:s'),
								'ended_at'   => Input::get('end_alt').' '.date('23:59:59')
								]);

			$this->artdetail->create([
								'article_id' => $id,
								'user_id' => Auth::user()->id,
								'title'   => Input::get('title'),
								'content' => Input::get('content'),
								'desc'    => Input::get('desc'),
								'lang'    => Input::get('lang', $this->lang)]);

			

			return Redirect::route('categories.articles.show', [Input::get('category', 'news'), $id]);
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
		$article = $this->artjoin->withTrashed()->where('category', $cat)->where('lang', $this->lang)->where('id', $id)->first();

		if(count($article) == 0)
		{	$article = $this->artjoin->withTrashed()->where('category', $cat)->where('id', $id)->first();
			if(count($article) == 0)
				return Redirect::route('categories.articles.index', $cat);
		}

		$date = static::localDate($article->created_at);

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.show', compact('cat', 'article', 'date'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($cat, $id)
	{
		$article = $this->artjoin->withTrashed()->where('category', $cat)->where('lang', $this->lang)->where('id', $id)->first();
		
		foreach ($this->category->all() as $c)
		$category[$c->name] = trans('messages.'.$c->name);

		if (is_null($article))
		{
			return Redirect::route('categories.articles.index', $cat);
		}

		$cd = new Datetime($article->created_at);
		$create_date = $cd->format('j').' '.static::localMonth($cd->format('F')).' '.$cd->format('Y');

		$ed = new Datetime($article->ended_at);
		$end_date = $ed->format('j').' '.static::localMonth($ed->format('F')).' '.$ed->format('Y');

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.edit', compact('article', 'cat', 'category', 'create_date', 'end_date', 'cd', 'ed'));
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
			$c = $this->category->where('name', Input::get('category', 'news'))->first();
			
			$this->article->withTrashed()->find($id)->update([
								'cat_id'     => $c->id,
								'deleted_at' => (Input::get('deleted'))?date('Y-m-d H:t:s'):null,
								'created_at' => Input::get('create_alt').' '.date('H:t:s'),
								'ended_at'   => Input::get('end_alt').' '.date('23:59:59')
								]);

			$this->artdetail->where('article_id', $id)
							->where('lang', $this->lang)
							->update([
								'user_id' => Auth::user()->id,
								'title'   => Input::get('title'),
								'content' => Input::get('content'),
								'desc'    => Input::get('desc')]);

			return Redirect::route('categories.articles.show', [Input::get('category', 'news'), $id]);
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
		$art = $this->article->withTrashed()->find($id);
		($art->deleted_at == null)?$art->delete():$art->forceDelete();

		return Redirect::route('categories.articles.index', $cat);
	}

}
