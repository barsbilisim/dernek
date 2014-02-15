<?php

class Payment extends Eloquent
{
	protected $table      = 'payments';
	protected $guarded    = array();
	protected $fillable   = array();
	// protected $softDelete = true;
	public    $timestamps = false;

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

}
