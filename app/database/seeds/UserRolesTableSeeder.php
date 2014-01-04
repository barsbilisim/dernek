<?php

class UserRolesTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('roles')->truncate();

		$roles = array(
			['user_id' => '52c19a22743c9',
			'role_id'  => '1',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['user_id' => '52c19a22743c9',
			'role_id'  => '2',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['user_id' => '52c19a2288bd1',
			'role_id'  => '3',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]

		);

		// Uncomment the below to run the seeder
		DB::table('user_roles')->insert($roles);
	}

}
