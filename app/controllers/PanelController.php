<?php

class PanelController extends BaseController
{
	protected $lang;
	protected $artjoin;

	public function __construct(ArticleJoin $artjoin)
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

		$this->artjoin   = $artjoin;
	}
	
	public function Index()
	{
		$this->layout->title   = 'Admin panel';
		$this->layout->content = View::make('panel.index');
	}

	public function Article()
	{
		$articles = $this->artjoin->orderBy('created_at', 'desc')->get();

		$this->layout->title   = 'All articles';
		$this->layout->content = View::make('panel.article', compact('articles'));
	}
}