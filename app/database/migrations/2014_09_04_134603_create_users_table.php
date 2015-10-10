<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {

			$table->increments('id');
			$table->integer('details_id');
			$table->string('username',20)->unique();
			$table->string('password',60);
			$table->string('email',50)->unique();
			$table->string('user_level',8);
			$table->string('remember_token',100);
			$table->integer('active');
			$table->string('password_tmp',60);
			$table->string('activation_code',60);
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
