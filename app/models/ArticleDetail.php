<?php

class ArticleDetail extends Eloquent
{
	protected $table = 'article_details';
	protected $guarded    = array();
	protected $fillable   = array();

	public function article()
	{
		return $this->belongsTo('Article', 'article_id');
	}
}
