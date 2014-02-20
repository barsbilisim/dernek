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

	public function getGallery()
	{
		return $this->images()->where("status", 1)->take(4)->get();
	}

	public function getImage($id)
	{	
		return $this->images()->where('id', $id)->first();
	}

	public function getMain()
	{
		return $this->images()->where("status", 1)->where('main', 1)->get();
	}
	public function getVideo($content)
	{	
		$www = strstr($content,"watch?v=");
		$path_parts=explode('&', $www);
		$path_parts2=explode('=', $path_parts[0]);
		return $path_parts2[1];
	}

	public function getCategoryIcon($news = "book", $events = "gift",$ints = "user",$announces="bullhorn",$slides="file",$gallery="picture",$videos="facetime-video")
	{
		$category = $this->category;

		switch ($category) {
			case 'news':
				return $news;
				break;
			
			case 'events':
				return $events;
				break;
			case 'ints':
				return $ints;
				break;
			case 'announces':
				return $announces;
				break;
			case 'slides':
				return $slides;
				break;
			case 'photos':
				return $gallery;
				break;
			case 'videos':
				return $videos;
				break;
			default:
				return 'user';
				break;
		}

	}
}

