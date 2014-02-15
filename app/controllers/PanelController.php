<?php

class PanelController extends BaseController
{
	protected $lang;

	public function __construct(ArticleJoin $artjoin)
	{
		$this->layout = (User::inRoles(['admin']))?'layouts.kendo':'layouts.default';
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

	// Payment API
	public function listPayments()
	{
		$pm = PaymentJoin::orderBy('id', 'desc')->get();

		return Response::make($pm);
	}

	public function updatePayments()
	{	
		$input = json_decode(Input::get('models'), true)[0];

		$pm = Payment::find($input['id']);
		$pm->user_id = $input['user']['id'];
		$pm->amount  = $input['amount'];
		$pm->type    = $input['type'];
		$pm->date    = $input['date'];
		$pm->description = $input['description'];
		$pm->save();

		$pm = PaymentJoin::find($pm->id);

		return Response::make($pm);
	}

	public function createPayments()
	{	
		$input = json_decode(Input::get('models'), true)[0];
		
		$pm = new Payment;
		$pm->user_id = $input['user']['id'];
		$pm->amount  = $input['amount'];
		$pm->type    = $input['type'];
		$pm->date    = $input['date'];
		$pm->description = $input['description'];
		$pm->save();

		$pm = PaymentJoin::find($pm->id);

		return Response::make($pm);
	}

	public function destroyPayments()
	{	
		$input = json_decode(Input::get('models'), true)[0];
		
		Payment::find($input['id'])->delete();

		return Response::make($input);
	}

	// Payment types API
	public function listPaymentTypes()
	{
		$settings = Settings::where('name', 'payment_type')->get();

		return Response::make($settings);
	}

	// Users API
	public function listUsers()
	{
		$users = User::all();
		foreach($users as $u)
			$u['fullname'] = $u->firstname.' '.$u->lastname;

		return Response::make($users);
	}
}