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
			'big'        => 'http://placehold.it/1200x900',
			'thumb'		 => 'http://placehold.it/400x300',
			'kg'         => 'placehold it 1200x900',
			'tr'         => 'placehold it 1200x900',
			'main'       => 1,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c52129b4ab7',
			'article_id' => '52c19a22ce106',
			'big'        => 'http://placehold.it/1400x1000',
			'thumb'		 => 'http://placehold.it/420x300',
			'kg'         => 'placehold it 1200x900',
			'tr'         => 'placehold it 1200x900',
			'main'       => 0,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c52129b4ae5',
			'article_id' => '52c19a22ce11b',
			'big'        => 'http://placehold.it/1000x800',
			'thumb'		 => 'http://placehold.it/350x200',
			'kg'         => 'placehold it 1200x900',
			'tr'         => 'placehold it 1200x900',
			'main'       => 1,
			'status'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
		);

		// Uncomment the below to run the seeder
		DB::table('images')->insert($images);
	}

}
