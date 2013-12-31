<?php

class Category extends Eloquent
{

	protected $table = 'categories';
	protected $guarded    = array();
	protected $fillable   = array();
	protected $softDelete = true;

	public function articles()
	{
		return $this->hasMany('Article', 'cat_id');
	}
}
