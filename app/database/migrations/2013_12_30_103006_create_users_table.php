<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->string('id', 20)->unique()->primary();
			$table->string('email', 200)->unique();
			$table->string('password', 100);
			$table->string('phone', 20)->nullable();
			$table->boolean('active')->default(1);

			$table->string('firstname', 100)->nullable();
			$table->string('lastname', 100)->nullable();
			$table->date('birth_date')->nullable();
			$table->string('marital_status', 255)->nullable();
			$table->string('occupation', 255)->nullable();
			$table->string('company', 255)->nullable();
			$table->string('passport', 255)->nullable();
			$table->string('photo', 255)->nullable();
			$table->string('bachelor', 255)->nullable();
			$table->string('master', 255)->nullable();
			$table->string('phd', 255)->nullable();

			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
