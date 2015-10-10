<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function($table) {
			$table->increments('id');
			$table->string('name',100);
			$table->text('actor');
			$table->string('director',30);
			$table->integer('category_id')->unsigned();
			$table->string('main_language',15);
			$table->tinyInteger('number_of_discs');
			$table->string('series',30);
			$table->string('run_time',30);
			$table->string('release_year',4);
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movies');
	}

}
