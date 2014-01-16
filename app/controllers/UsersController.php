<?php

class UsersController extends BaseController
{

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;
	protected $role;
	protected $lang;

	public function __construct(User $user, Role $role)
	{
		$this->layout = (User::inRoles(['admin']))?'layouts.panel':'layouts.default';
		$this->lang   = Config::get("app.locale");
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
		
		$this->beforeFilter(function()
		{
			if(!User::inRoles(['admin']))
				return Redirect::guest('login');
		}, ['except' => ['show', 'edit', 'update']]);

		$this->user = $user;
		$this->role = $role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->where('active', '<>', 2);
		$regs  = $this->user->where('active', 2);

		if(Input::get('show') == 'deleted')
		{
			$users = $users->onlyTrashed();
			$regs  = $regs->onlyTrashed();
		}

		$users = $users->get();
		$regs  = $regs->get();

		$this->layout->title   = 'Users';
		$this->layout->content = View::make('users.index', compact('users', 'regs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = $this->role->all();

		$this->layout->title   = 'Create';
		$this->layout->content = View::make('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		static::globalXssClean();			

			$input = Input::all();
			$validation = Validator::make($input,
						[
						'email'      => 'required|email|unique:users,email|max:250',
						'phone'      => 'numeric',
						'firstname'  => 'required|max:100',
						'lastname'   => 'required|max:100',
						'passport'   => 'max:100',
						'birth_date'     => 'required|max:100',
						'marital_status' => 'required|max:100'
						]);

		if ($validation->passes())
		{
			$file  = Input::get('dataUrl');
			$crop  = Input::get('coords');
			$id    = uniqid();
			$email = Input::get('email'); 
			$pass  = static::generatePassword();
			$user  = new User;

			if($file != "" && $crop != "")
			{
				$targ_w = 400;
				$targ_h = 400;
				$quality = 80;

				$crop  = json_decode($crop, true);
				$file  = base64_decode($file);
				$img_r = imagecreatefromstring($file);				
				$dst_r = ImageCreateTrueColor($targ_w, $targ_h);

				imagecopyresampled($dst_r, $img_r, 0, 0, $crop['x'], $crop['y'], $targ_w, $targ_h, $crop['w'], $crop['h']);
				
				$path = "img/users";
				$name = $id.".jpg";

				if(!File::isDirectory($path))
					File::makeDirectory($path);

				imagejpeg($dst_r, $path."/".$name, $quality);
				imagedestroy($dst_r); // release from memory

				$user->photo = $path."/".$name;
			}

			$user->id         = $id;
			$user->email      = $input['email'];
			$user->phone      = $input['phone'];
			$user->firstname  = $input['firstname'];
			$user->lastname   = $input['lastname'];
			$user->passport   = $input['passport'];
			$user->occupation = $input['occupation'];
			$user->company    = $input['company'];
			$user->birth_date = $input['birth_date'];
			$user->bachelor   = $input['bachelor'];
			$user->master     = $input['master'];
			$user->phd        = $input['phd'];
			$user->password   = Hash::make($pass);
			$user->marital_status = $input['marital_status'];
			
			$user->save();

			foreach ($this->role->all() as $role)
			{
				if(in_array($role->name, Input::get('roles',[])))
				$role->users()->attach($id);
			}

			Mail::send('emails.auth.usercreate', ["password" => $pass, "email" => $email], function($message) use($email) {
				$message->to($email)->subject('New account');
			});

			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.create')
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
		if(Auth::user()->id == $id || User::inRoles(['admin']))
		{
			$user = $this->user->withTrashed()->findOrFail($id);

			$d = new Datetime($user->birth_date);
			$date = $d->format('j').' '.static::localMonth($d->format('F')).' '.$d->format('Y');

			$this->layout->title   = 'User';
			$this->layout->content = View::make('users.show', compact('user', 'date'));
		}
		else
		return Redirect::to('login');		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Auth::user()->id == $id || User::inRoles(['admin']))
		{
			$user  = $this->user->withTrashed()->find($id);
			$roles = $this->role->all();

			if (is_null($user))
			{
				return Redirect::route('users.index');
			}

			$d = new Datetime($user->birth_date);
			$date = $d->format('j').' '.static::localMonth($d->format('F')).' '.$d->format('Y');

			$this->layout->title   = 'Edit';
			$this->layout->content = View::make('users.edit', compact('user', 'roles', 'date'));
		}
		else
		return Redirect::to('login');	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Auth::user()->id == $id || User::inRoles(['admin']))
		{
			static::globalXssClean();			

			if(Input::get('dataUrl'))
			{
				$file = Input::get('dataUrl');
				$crop = Input::get('coords');

				if($file != "" && $crop != "")
				{
					$targ_w = 400;
					$targ_h = 400;
					$quality = 80;

					$crop  = json_decode($crop, true);
					$file  = base64_decode($file);
					$img_r = imagecreatefromstring($file);				
					$dst_r = ImageCreateTrueColor($targ_w, $targ_h);

					imagecopyresampled($dst_r, $img_r, 0, 0, $crop['x'], $crop['y'], $targ_w, $targ_h, $crop['w'], $crop['h']);
					
					$path = "img/users";
					$name = $id.".jpg";

					if(!File::isDirectory($path))
						File::makeDirectory($path);

					imagejpeg($dst_r, $path."/".$name, $quality);
					imagedestroy($dst_r); // release from memory

					$this->user->withTrashed()->find($id)->update(['photo' => $path."/".$name]);
				}
			}
			else
			if(Input::get('firstname'))
			{
				$input = array_except(Input::all(), '_method');
				$validation = Validator::make($input,
							[
							'phone'      => 'numeric',
							'firstname'  => 'required|max:100',
							'lastname'   => 'required|max:100',
							'passport'   => 'max:100',
							'occupation' => 'required',
							'company'    => 'required',
							'birth_date'     => 'required|max:100',
							'marital_status' => 'required|max:100'
							]);

				if ($validation->passes())
				{
					$user = $this->user->withTrashed()->find($id);
					$user->phone          = $input['phone'];
					$user->firstname      = $input['firstname'];
					$user->lastname       = $input['lastname'];
					$user->passport       = $input['passport'];
					$user->occupation     = $input['occupation'];
					$user->company        = $input['company'];
					$user->birth_date     = $input['birth_date'];
					$user->marital_status = $input['marital_status'];
					$user->bachelor       = $input['bachelor'];
					$user->master         = $input['master'];
					$user->phd            = $input['phd'];
					$user->save();

					return Redirect::route('users.show', $id);
				}

				return Redirect::to('/users/'.$id.'/edit?part=profile')
					->withInput()
					->withErrors($validation);
			}
			else
			if(Input::get('email'))
			{
				$input = array_except(Input::all(), '_method');
				$validation = Validator::make($input,
							[
							'email'    => 'required|email|unique:users,email,'.$id.'|max:250',
							'password' => 'min:6|max:100|alpha_dash'
							]);

				if ($validation->passes())
				{
					$user = $this->user->withTrashed()->find($id);

					$user->email      = $input['email'];
					$user->deleted_at = (Input::get('deleted') == 1)?date('Y-m-d H:t:s'):null;
					
					if(Input::get('password') != '')
						$user->password = Hash::make($input['password']);

					$user->save();

					foreach ($this->role->all() as $role)
					{
						$user->roles()->detach($role->id);
						if(in_array($role->name, Input::get('roles',[])))
						$user->roles()->attach($role->id);
					}

					return Redirect::route('users.show', $id);
				}

				return Redirect::to('/users/'.$id.'/edit?part=settings')
					->withInput()
					->withErrors($validation);
			}

			return Redirect::route('users.show', $id);
		}
		else
		return Redirect::to('login');	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->id != $id)
		{
			$user = $this->user->withTrashed()->find($id);
			
			if($user->deleted_at == null)
				$user->delete();
			else
			{
				if($user->photo != null || $user->photo != "")
					File::delete($user->photo);

				$user->forceDelete();
				return Redirect::to('/users?show=deleted');
			}
		}
		return Redirect::route('users.index');
	}

}
