<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			['id'        => '52d140a5537cf',
			'email'      => 'nurchin@gmail.com',
			'password'   => Hash::make('admin'),
			'phone'      => '5067919414',
			'active'     => 1,

			'firstname'  => 'Chyngyz',
			'lastname'   => 'Begimkulov',
			'birth_date' => '1984-01-01',
			'marital_status' => 'Single',
			'occupation' => 'Web developer',
			'company'    => 'Bars Bilisim',
			'passport'   => '99787028796',
			'photo'      => null,
			'bachelor'   => 'KTU MANAS',
			'master'     => null,
			'phd'		 => null,

			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
