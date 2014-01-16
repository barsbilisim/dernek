<?php

class GroupsTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('groups')->truncate();

		$groups = array(
			['id'  => uniqid(),
			'name' => 'all users',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'  => uniqid(),
			'name' => 'private',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'  => uniqid(),
			'name' => 'genel kurul',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		// DB::table('groups')->insert($groups);
	}

}
