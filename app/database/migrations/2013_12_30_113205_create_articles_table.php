<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->string('id', 20)->unique()->primary();
			$table->string('cat_id', 20)->references('id')->on('categories');
			$table->boolean('status')->default(1);
			$table->boolean('slider')->default(0);
			$table->boolean('anounce')->default(0);
			$table->softDeletes();
			$table->timestamp('ended_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
