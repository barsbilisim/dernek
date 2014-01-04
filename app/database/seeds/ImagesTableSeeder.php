<?php

class ImagesTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('images')->truncate();

		$images = array(
			['id'        => '52c52129b4a6c',
			'article_id' => '52c19a22ce106',
			'big'        => 'img/article/52c19a22ce106/52c80ea0b671a.jpg',
			'thumb'		 => 'img/article/52c19a22ce106/52c80ea1004a5.jpg',
			'kg'         => '',
			'tr'         => '',
			'main'       => 1,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c52129b4ab7',
			'article_id' => '52c19a22ce106',
			'big'        => 'img/article/52c19a22ce106/52c80ebce3b3a.jpg',
			'thumb'		 => 'img/article/52c19a22ce106/52c80ebd3f207.jpg',
			'kg'         => '',
			'tr'         => '',
			'main'       => 0,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c52129b4ae5',
			'article_id' => '52c19a22ce11b',
			'big'        => 'img/article/52c19a22ce11b/52c80ed98365a.jpg',
			'thumb'		 => 'img/article/52c19a22ce11b/52c80ed9d0fcc.jpg',
			'kg'         => '',
			'tr'         => '',
			'main'       => 1,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
		);

		// Uncomment the below to run the seeder
		DB::table('images')->insert($images);
	}

}
