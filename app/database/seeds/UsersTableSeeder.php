<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			['id'        => '52c19a22743c9',
			'email'      => 'nurchin@gmail.com',
			'password'   => Hash::make('admin'),
			'phone'      => '5309428200',
			'balance'    => 40,
			'active'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c19a2288bd1',
			'email'      => 'cbega@mail.ru',
			'password'   => Hash::make('admin'),
			'phone'      => '5067919414',
			'balance'    => -200,
			'active'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')],
			['id'        => '52c19a229d045',
			'email'      => 'cbegi@mail.ru',
			'password'   => Hash::make('admin'),
			'phone'      => '5342990890',
			'balance'    => 0,
			'active'     => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')]
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
