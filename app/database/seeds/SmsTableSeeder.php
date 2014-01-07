<?php

class SmsTableSeeder extends Seeder
{

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('sms')->truncate();

		$sms = array(
			['id'     => uniqid(),
			'title'   => 'first sms',
			'content' => 'first smsm content',
			'pinned'  => 1,
			'created_at' => date('Y-m-d'),
			'updated_at' => date('Y-m-d')],
			['id'     => uniqid(),
			'title'   => 'second sms',
			'content' => 'second smsm content',
			'pinned'  => 1,
			'created_at' => date('Y-m-d'),
			'updated_at' => date('Y-m-d')],
			['id'     => uniqid(),
			'title'   => 'third sms',
			'content' => 'third smsm content',
			'pinned'  => 0,
			'created_at' => date('Y-m-d'),
			'updated_at' => date('Y-m-d')],
			['id'     => uniqid(),
			'title'   => 'fourth sms',
			'content' => 'fourth smsm content',
			'pinned'  => 0,
			'created_at' => date('Y-m-d'),
			'updated_at' => date('Y-m-d')]
		);

		// Uncomment the below to run the seeder
		DB::table('sms')->insert($sms);
	}

}
