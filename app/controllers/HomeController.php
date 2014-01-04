<?php

class HomeController extends BaseController
{

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $art;
	protected $lang;

	public function __construct(ArticleJoin $art)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get('app.locale');
		
		$this->art = $art;
	}

	
	public function Index()
	{
		$art = $this->art->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1');

		$news    = $art->where('category', 'news')->where('slider', '0')->take(6)->get();
		$slider  = $art->where('category', 'news')->where('slider', '1')->take(5)->get();
		$ints    = $art->where('category', 'ints')->take(4)->get();
		$anounce = $art->where('category', 'events')->where('anounce', 1)->take(1)->get();

		$counter = (count($anounce) > 0)?2:3;
		$events  = $art->where('ended_at', '>=', date('Y-m-d 00:00:00'))->where('category', 'events')->take($counter)->get();

		$this->layout->title   = trans('messages.home');
		$this->layout->content = View::make('home.index', compact('news', 'slider', 'ints', 'events', 'anounce'));
	}

}
