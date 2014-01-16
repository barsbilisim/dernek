<?php

class RolesTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('roles')->truncate();

		$roles = array(
			['id'  => '52d140a658c58',
			'name' => 'admin',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'  => '52d140a658c74',
			'name' => 'moder',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'  => '52d140a658c82',
			'name' => 'user',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]

		);

		// Uncomment the below to run the seeder
		DB::table('roles')->insert($roles);
	}

}
