<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UsersTableSeeder');
		// $this->call('ArticlesTableSeeder');
		// $this->call('ArticleDetailsTableSeeder');
		// $this->call('CategoriesTableSeeder');
		// $this->call('PagesTableSeeder');
		// $this->call('ImagesTableSeeder');
		// $this->call('RolesTableSeeder');
		// $this->call('UserRolesTableSeeder');
		$this->call('SmsTableSeeder');
	}

}