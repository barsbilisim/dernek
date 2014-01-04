<?php

class ArticlesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('articles')->truncate();

		$articles = array(
			['id'      => '52c19a22ce106',
			'cat_id'   => '1',
			'status'   => 1,
			'slider'   => 0,
			'anounce'  => 0,
			'ended_at' => date('Y-m-d H:i:s')],
			['id'      => '52c19a22ce11b',
			'cat_id'   => '2',
			'status'   => 1,
			'slider'   => 0,
			'anounce'  => 0,
			'ended_at' => date('Y-m-d H:i:s')],
			['id'      => '52c19a22ce128',
			'cat_id'   => '3',
			'status'   => 1,
			'slider'   => 0,
			'anounce'  => 0,
			'ended_at'    => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		DB::table('articles')->insert($articles);
	}

}
