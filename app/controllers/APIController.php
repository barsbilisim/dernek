<?php

class APIController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => ['post', 'put', 'delete']]);
		$this->beforeFilter('auth', ['on' => ['get', 'post', 'put', 'delete']]);
	}

	public function putArticleStatus($id)
	{
		$article = Article::findOrFail($id);
		$article->status = ($article->status == 1)?0:1;
		$article->save();
		return Response::json($article->status);


		return Response::json('error');
	}

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
}
