<?php

class APIController extends BaseController
{

	protected $article;

	public function __construct(Article $article)
	{
		$this->beforeFilter('auth|csrf', ['on' => 'post', 'on' => 'put']);

		$this->article  = $article;
	}

	public function getArticleStatus($id)
	{
		return $this->article->findOrFail($id)->status;
	}

	public function putArticleStatus($id)
	{
		$article = $this->article->findOrFail($id);
		$article->status = ($article->status == 1)?0:1;
		$article->save();
		return Response::json($article->status);
	}
}
