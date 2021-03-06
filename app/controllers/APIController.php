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
		$users   = new User;

		if(Input::get('del') == 1)
		$users->withTrashed();
		// if(is_numeric(Input::get('min')))
		// $users->where('balance', '>=' , Input::get('min'));
		// if(is_numeric(Input::get('max')))
		// $users->where('balance', '<=', Input::get('max'));

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
			$content .= ($user->deleted_at == null)?'<tr>':'<tr class="danger">';
			$content .= '
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
		$users = Group::find($gid)->users()->withTrashed()->get();

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
			$content .= ($user->deleted_at == null)?'<tr>':'<tr class="danger">';
			$content .= '
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
		$users = Role::find($rid)->users()->withTrashed()->get();

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
			$content .= ($user->deleted_at == null)?'<tr>':'<tr class="danger">';
			$content .= '
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
		$articles = ArticleJoin::orderBy('created_at', Input::get('sort-date', 'desc'));

		if(Input::get('del') == 1)
		$articles->onlyTrashed();

		if(Input::get('cat'))
		$articles->where('category', Input::get('cat'));

		$content = '';
		if ($articles->count()):
			$content = '<table class="table article tooltip-div"><thead>
				<tr>
					<th>title</th>
					<th>language</th>
					<th style="width:140px; text-align:center">created at</th>
					<th style="width:140px"></th>
				</tr>
			</thead><tbody>';

		foreach($articles->get() as $article):
			$deleted   = ($article->deleted_at == null)?'':'text-decoration: line-through';
			$content .=  ($article->status == 1)?'<tr>':'<tr class="danger">';
			$content .=	'
			<td style="'.$deleted.'"><a target="_blank" href="'.route('categories.articles.show', [$article->category, $article->id]).'">'.$article->title.'</a></td>
				<td>'.trans($article->lang).'</td>
				<td>'.$article->created_at.'</td>
				<td style="text-align:right">
				<button type="button" class="btn btn-default btn-xs delete-article" article-id="'.$article->id.'" title="delete"><span class="glyphicon glyphicon-remove"></span></button>
				</td>
			</tr>';
		endforeach;

		$content .= '</tbody></table>';
		endif;

		return Response::make($content);
	}

	public function getLoadmore()
	{
		$articles = ArticleJoin::orderBy('created_at', 'desc')->where('lang', $this->lang)->skip(Input::get('next', 1)*4)->take(4)->get();

		$content = '';
		foreach($articles as $n){
				$img = $n->link();
						if($n->category =='news'){$content .= View::make('home.categoryView.news', compact('n','img'));}
						if($n->category =='ints'){$content .= View::make('home.categoryView.ints', compact('n','img'));}
						if($n->category =='events'){$content .= View::make('home.categoryView.events', compact('n','img'));}
						if($n->category =='announces'){$content .= View::make('home.categoryView.announces', compact('n','img'));}
						if($n->category =='videos'){$content .= View::make('home.categoryView.videos', compact('n','img'));}
						if($n->category =='photos'){$content .= View::make('home.categoryView.photos', compact('n','img'));}
					}	
		return Response::json($content);
	}

	public function putArticleStatus($id)
	{
		$article = Article::withTrashed()->find($id);
		$article->status = ($article->status == 1)?0:1;
		if($article->save())
		return Response::json($article->status);


		return Response::json('error');
	}

	public function deleteArticle($id)
	{
		$art = Article::withTrashed()->find($id);
		if($art->deleted_at == null)
		{
			if($art->delete())
			return Response::json('success');
		}
		else
		{
			$art->forceDelete();
			return Response::json('success');
		}

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
		if($image->save())
		return Response::json($image->status);
		
		return Response::json('error');
	}

	public function putImageMain($id)
	{
		$image = Image::findOrFail($id);
		$image->main = ($image->main == 1)?0:1;
		if($image->save())
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
