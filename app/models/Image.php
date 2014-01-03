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

	public function desc()
	{
		return $this[Config::get('app.locale')];
	}

	public function big()
	{
		if(strpos($this->big, 'http://') === false)
			return '/'.$this->big;

		return $this->big;
	}

	public function thumb()
	{
		if(strpos($this->thumb, 'http://') === false)
			return '/'.$this->thumb;

		return $this->thumb;
	}
}
