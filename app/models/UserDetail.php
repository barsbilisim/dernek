<?php

class UserDetail extends Eloquent
{
	protected $table = 'user_details';
	protected $guarded    = array();
	protected $fillable   = array();

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}