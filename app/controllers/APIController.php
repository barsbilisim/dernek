<?php

class APIController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
	}

	//Article--------------------------------------------------------------------------------
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
		$durum = static::send_sms("http://api.smsvitrini.com/index.php", "islem=2&user=".$user."&pass=".$pass);

		if(Input::json('save') == 'true')
		{
			$sms = Sms::create(
						['id'     => uniqid(),
						'content' => Input::json('content', ''),
						'pinned'  => (Input::json('pin') == 'true')?1:0
						]
			);
		}

		return Response::json(compact('status', 'durum', 'sms'));
	}

	public function deleteSMS($id)
	{
		if(SMS::findOrFail($id)->delete())
		return Response::json('success');
		
		return Response::json('error');
	}
	//--------------------------------------------------------------------------------------
}
