<?php

class APIController extends BaseController
{
	protected $lang;
	public function __construct()
	{
		$this->lang = Config::get('app.locale');
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete'], 'except' => ['getLoadmore']]);
	}

	//Users--------------------------------------------------------------------------------
	public function getUsers()
	{
		$users   = User::orderBy('balance', 'asc');

		if(is_numeric(Input::get('min')))
		$users->where('balance', '>=' , Input::get('min'));
		if(is_numeric(Input::get('max')))
		$users->where('balance', '<=', Input::get('max'));

		$content = '';
		
		if ($users->count()):
			$content = '<table class="table"><thead>
				<tr>
					<th>email</th>
					<th>balance</th>
					<th>phone</th>
					<th></th>
				</tr>
			</thead><tbody>';

		foreach($users->get() as $user):
			$content .= '
			<tr>
				<td>'.$user->email.'</td>
				<td>'.$user->balance.'</td>
				<td id="user-phone">'.$user->phone.'</td>					
				<td style="text-align:right">
					<input type="hidden" name="users[]" value="'.$user->id.'">
					<button type="button" class="btn btn-default btn-xs delete-user"><span class="glyphicon glyphicon-remove"></span></button>
				</td>
			</tr>';
		endforeach;

		$content .= '</tbody></table>';
		endif;

		return Response::make($content);
	}

	//---------------------------------------------------------------------------------------

	//Groups--------------------------------------------------------------------------------
	public function getGroupUsers($gid)
	{
		$users = Group::find($gid)->users;

		$content = '';
		
		if ($users->count()):
			$content = '<table class="table"><thead>
				<tr>
					<th>email</th>
					<th>balance</th>
					<th>phone</th>
					<th></th>
				</tr>
			</thead><tbody>';

		foreach($users as $user):
			$content .= '
			<tr>
				<td>'.$user->email.'</td>
				<td>'.$user->balance.'</td>					
				<td id="user-phone">'.$user->phone.'</td>					
				<td style="text-align:right"><button type="button" class="btn btn-default btn-xs delete-user" user-id="'.$user->id.'"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>';
		endforeach;

		$content .= '</tbody></table>';
		endif;

		return Response::make($content);
	}

	public function deleteGroupUser($gid, $uid)
	{
		if(Group::find($gid)->users()->detach($uid))
			return Response::json('success');
		else
			return Response::json('error');
	}

	//---------------------------------------------------------------------------------------

	//Roles--------------------------------------------------------------------------------
	public function getRoleUsers($rid)
	{
		$users = Role::find($rid)->users;

		$content = '';
		
		if ($users->count()):
			$content = '<table class="table"><thead>
				<tr>
					<th>email</th>
					<th>balance</th>
					<th>phone</th>
					<th></th>
				</tr>
			</thead><tbody>';

		foreach($users as $user):
			$content .= '
			<tr>
				<td>'.$user->email.'</td>
				<td>'.$user->balance.'</td>					
				<td id="user-phone">'.$user->phone.'</td>					
				<td style="text-align:right"><button type="button" class="btn btn-default btn-xs delete-user" user-id="'.$user->id.'"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>';
		endforeach;

		$content .= '</tbody></table>';
		endif;

		return Response::make($content);
	}

	public function deleteRoleUser($rid, $uid)
	{
		if(Role::find($rid)->users()->detach($uid))
			return Response::json('success');
		else
			return Response::json('error');
	}

	//---------------------------------------------------------------------------------------

	//Article--------------------------------------------------------------------------------
	public function getArticles()
	{
		$articles = ArticleJoin::withTrashed()->orderBy('created_at', Input::get('sort-date', 'desc'));

		$articles = $articles->get();

		$content = '';
		
		if ($articles->count()):
			$content = '<table class="table"><thead>
				<tr>
					<th>title</th>
					<th>created</th>
					<th></th>
				</tr>
			</thead><tbody>';

		foreach($articles as $article):
			$content .= ($article->deleted_at == null)?'<tr>':'<tr class="danger">';
			$content .=	'<td>'.$article->title.'</td>
				<td>'.$article->created_at.'</td>
				<td style="text-align:right"><button type="button" class="btn btn-default btn-xs delete-article" user-id="'.$article->id.'"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>';
		endforeach;

		$content .= '</tbody></table>';
		endif;

		return Response::make($content);
	}

	public function getLoadmore()
	{
		$articles = ArticleJoin::orderBy('created_at', 'desc')->where('lang', $this->lang)->where('category', Input::get('cat', 'news'))->skip(Input::get('next', 6)*3)->take(3)->get();

		$content = '';
		foreach($articles as $article):
			if($img = $article->link())
			$content .= '<div class="col-sm-4 col-lg-4 news-box-block" style="position:relative;">
							<div class="thumbnail">
							<a href="'.$img->big.'" class="news-box-link " rel="prettyPhoto[news]" title="'.$img->desc.'">
								<img class="news-box-image" src="'.$img->thumb.'">
							</a>
							<a href="'.route('categories.articles.show', [$article->category, $article->id]).'"><p>'.$article->title.'</p></a>
							<p class="thumb_date" style="position:absolute; background: rgba(255,255,255, 0.8); padding:2px 5px; top:8px; right:8px; font-style:italic; color: #888; font-size:12px;">'.(new DateTime($article->created_at))->format('d M Y').'</p>
							</div>
						</div>';
		endforeach;

		return Response::json($content);
	}

	public function putArticleStatus($id)
	{
		$article = Article::findOrFail($id);
		$article->status = ($article->status == 1)?0:1;
		$article->save();
		return Response::json($article->status);


		return Response::json('error');
	}
	//--------------------------------------------------------------------------------------

	//Image--------------------------------------------------------------------------------
	public function putImageDesc($id)
	{
		$image = Image::findOrFail($id);
		$image[Config::get('app.locale')] = Input::json('desc');
		
		if($image->save())
		return Response::json('success');
		
		return Response::json('error');
	}

	public function putImageStatus($id)
	{
		$image = Image::findOrFail($id);
		$image->status = ($image->status == 1)?0:1;
		$image->save();
		return Response::json($image->status);
		
		return Response::json('error');
	}

	public function putImageMain($id)
	{
		$image = Image::findOrFail($id);
		$image->main = ($image->main == 1)?0:1;
		$image->save();
		return Response::json($image->main);
		
		return Response::json('error');
	}
	//--------------------------------------------------------------------------------------


	//SMS-----------------------------------------------------------------------------------
	public function sendSMS()
	{
		$user = '5334660688';
		$pass = 'kdmk123kdmk';
		$status = static::send_sms('http://api.smsvitrini.com/index.php', 'islem=1&user='.$user.'&pass='.$pass.'&mesaj='.Input::json('content').'&numaralar='.Input::json('nums').'&baslik='.Input::json('title'));

		if(Input::json('save') == 'true')
		{
			Sms::create(
				['id'     => uniqid(),
				'content' => Input::json('content', ''),
				'pinned'  => (Input::json('pin') == 'true')?1:0
				]
			);
		}

		return Response::json(compact('status'));
	}

	public function deleteSMS($id)
	{
		if(SMS::findOrFail($id)->delete())
		return Response::json('success');
		
		return Response::json('error');
	}
	//--------------------------------------------------------------------------------------
}
