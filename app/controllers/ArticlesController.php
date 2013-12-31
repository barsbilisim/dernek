<?php

class ArticlesController extends BaseController
{

	/**
	 * Article Repository
	 *
	 * @var Article
	 */
	protected $article;
	protected $article_detail;
	protected $article_join;
	protected $lang;

	public function __construct(Article $article, ArticleDetail $article_detail, ArticleJoin $article_join)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('auth|csrf', ['on' => 'post', 'on' => 'put']);

		$this->article  = $article;
		$this->article_detail = $article_detail;
		$this->article_join   = $article_join;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($cat)
	{
		$articles = $this->article_join->where('category', $cat)->where('lang', $this->lang)->get();

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
		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.create', compact('cat'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Article::$rules);

		if ($validation->passes())
		{
			$this->article->create($input);

			return Redirect::route('articles.index');
		}

		return Redirect::route('articles.create')
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
	public function show($cat, $id)
	{
		$article = $this->article_join->where('category', $cat)->where('lang', $this->lang)->where('id', $id)->firstOrFail();

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
		$article = $this->article->find($id);

		if (is_null($article))
		{
			return Redirect::route('articles.index');
		}

		$this->layout->title   = trans('messages.'.$cat);
		$this->layout->content = View::make('articles.edit', compact('article', 'cat'));
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
		$validation = Validator::make($input, Article::$rules);

		if ($validation->passes())
		{
			$article = $this->article->find($id);
			$article->update($input);

			return Redirect::route('articles.show', $id);
		}

		return Redirect::route('articles.edit', $id)
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
	public function destroy($cat, $id)
	{
		$this->article->find($id)->delete();

		return Redirect::route('categories.articles.index', $cat);
	}

}
