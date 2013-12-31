<?php

class Page extends Eloquent
{
	protected $table = 'pages';
	protected $guarded    = array();
	protected $fillable   = array();
	protected $softDelete = true;
}
