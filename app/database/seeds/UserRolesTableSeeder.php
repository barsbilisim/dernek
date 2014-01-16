<?php

class UserRolesTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('user_roles')->truncate();

		$roles = array(
			['user_id' => '52d140a5537cf',
			'role_id'  => '52d140a658c58',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		DB::table('user_roles')->insert($roles);
	}

}
