<?php

class Image extends Eloquent
{
	protected $table      = 'images';
	protected $guarded    = array();
	protected $fillable   = array();
	protected $softDelete = true;
	// public    $timestamps = false;

	public function article()
	{
		return $this->belongsTo('Article', 'article_id');
	}
}
