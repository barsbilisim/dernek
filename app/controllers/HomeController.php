<?php

class HomeController extends BaseController
{

	/**
	 * Page Repository
	 * @var Page
	 */
	protected $art;
	protected $lang;

	public function __construct(ArticleJoin $art)
	{
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get('app.locale');
		$this->art = $art; 
	}

	
	public function Index()
	{
		$news     = $this->art->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1')->where('category', 'news')->take(6)->get();
		$slider   = $this->art->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1')->where('category', 'slides')->take(5)->get();
		$ints     = $this->art->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1')->where('category', 'ints')->take(6)->get();
		$announce = $this->art->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1')->where('category', 'announces')->first();

  		$counter = (count($announce) > 0)?2:3;
  		$events  = $this->art->orderBY('days','ASC')->orderBy('created_at', 'DESC')->where('lang'  , $this->lang)->where('status', '1')->where('category', 'events')->where('ended_at', '>=', date('Y-m-d 00:00:00'))->take($counter)->get();
		
		$this->layout->title   = trans('messages.home');
		$this->layout->content = View::make('home.index', compact('news', 'slider', 'ints', 'events', 'announce', 'counter'));
	}

}
