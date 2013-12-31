<?php

class Article extends Eloquent
{
	protected $table = 'articles';
	protected $guarded    = array();
	protected $fillable   = array();
	protected $softDelete = true;
	public $timestamps = false;

	public function category()
	{
		return $this->belongsTo('Category', 'cat_id');
	}

	public function details()
	{
		return $this->hasMany('ArticleDetail', 'article_id');
	}

	public function detail()
	{
		return $this->details($id)->lang;
	}
}
