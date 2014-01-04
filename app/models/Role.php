<?php

class Role extends Eloquent
{
	protected $table      = 'roles';
	protected $guarded    = array();
	protected $fillable   = array();
	//protected $softDelete = true;
	//public    $timestamps = false;

	public function users()
	{
		return $this->belongsToMany('User', 'user_roles');
	}
}
