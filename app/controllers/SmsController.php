<?php

class SmsController extends BaseController
{

	/**
	 * Sm Repository
	 *
	 * @var Sm
	 */
	protected $sms;
	protected $lang;

	public function __construct(Sms $sms)
	{
		$this->layout = 'layouts.default';
		$this->lang   = Config::get("app.locale");

		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(Auth::check() && !Auth::user()->inRoles(['admin']))
				return Redirect::guest('login');
		});

		$this->sms = $sms;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sms = $this->sms->orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->take(50)->get();

		$user = "5334660688";
		$pass = "kdmk123kdmk";

		$durum = static::send_sms("http://api.smsvitrini.com/index.php", "islem=2&user=".$user."&pass=".$pass);

		$this->layout->title   = 'Sms';
		$this->layout->content = View::make('sms.index', compact('sms', 'durum'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pinned = $this->sms->orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->where('pinned', 1)->take(30)->get();
		$normal = $this->sms->orderBy('pinned', 'DESC')->orderBy('created_at', 'DESC')->where('pinned', 0)->take(30)->get();

		$this->layout->title   = 'Create sms';
		$this->layout->content = View::make('sms.create', compact('pinned', 'normal'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, [
						'title'   => 'required|min:5|max:100',
						'content' => 'required|min:1|max:1000']);

		if ($validation->passes())
		{
			if($input['smsid'] == "")
			$this->sms->create(['id' => uniqid(), 'title' => $input['title'], 'content' => $input['content'], 'pinned' => Input::get('pin', 0)]);
			else
			$this->sms->findOrFail($input['smsid'])->update(['title' => $input['title'], 'content' => $input['content'], 'pinned' => Input::get('pin', 0)]);

			return Redirect::route('sms.create');
		}

		return Redirect::route('sms.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sms = $this->sms->findOrFail($id);

		$this->layout->title   = 'Sms details';
		$this->layout->content = View::make('sms.show', compact('sms'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$sm = $this->sm->find($id);

		if (is_null($sm))
		{
			return Redirect::route('sms.index');
		}

		$this->layout->title   = 'Edit sm';
		$this->layout->content = View::make('sms.edit', compact('sm'));
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
		$validation = Validator::make($input, []);

		if ($validation->passes())
		{
			$sm = $this->sm->find($id)->update($input);

			return Redirect::route('sms.show', $id);
		}

		return Redirect::route('sms.edit', $id)
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
		$this->sm->find($id)->delete();

		return Redirect::route('sms.index');
	}

}
