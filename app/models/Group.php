<?php

class Group extends Eloquent
{
	protected $table      = 'groups';
	protected $guarded    = array();
	protected $fillable   = array();
	//protected $softDelete = true;
	//public    $timestamps = false;

	public function users()
	{
		return $this->belongsToMany('User', 'user_groups');
	}
}
