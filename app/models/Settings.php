<?php

class Settings extends Eloquent
{
	protected $table      = 'settings';
	protected $guarded    = array();
	protected $fillable   = array();
	// protected $softDelete = true;
	public    $timestamps = false;
}
