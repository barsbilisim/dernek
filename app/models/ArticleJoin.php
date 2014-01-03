<?php

class ArticleJoin extends Eloquent
{
	protected $table = 'j_articles';
	protected $softDelete = true;

	public function images()
	{
		return $this->hasMany('Image', 'article_id');
	}

	public function link()
	{
		$img = json_decode('{"big":"", "thumb":"", "desc":""}');
		
		$image = $this->getMain();
		$count = count($image);
		if($image && $count > 0)
		{
			$image = $image[rand(0, $count - 1)];

			$img->big   = $image->big();
			$img->thumb = $image->thumb();
			$img->desc  = $image->desc();
		}
		else
		{
			$image = $this->getImages();
			$count = count($image);
			if($image && $count > 0)
			{
				$image = $image[rand(0, $count - 1)];

				$img->big   = $image->big();
				$img->thumb = $image->thumb();
				$img->desc  = $image->desc();
			}
		}
		
		if($img->big   == "") $img->big   = 'http://placehold.it/1200x800';
		if($img->thumb == "") $img->thumb = 'http://placehold.it/300x200';
		if($img->desc  == "") $img->desc  = $this->title;

		return $img;
	}

	public function getImages()
	{
		return $this->images()->where("status", 1)->get();
	}

	public function getImage($id)
	{	
		return $this->images()->where('id', $id)->first();
	}

	public function getMain()
	{
		return $this->images()->where("status", 1)->where('main', 1)->get();
	}
}
