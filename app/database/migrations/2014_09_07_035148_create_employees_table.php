<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function($table) {
			$table->increments('id');
			$table->string('first_name',30);
			$table->string('last_name',30);
			$table->integer('age');
			$table->string('gender',6);
			$table->date('DOB');
			$table->string('present_address',200);
			$table->string('permanent_address',200);
			$table->string('city',30);
			$table->string('state',30);
			$table->string('country',30);
			$table->string('mobile_no',30);
			$table->string('email',50);
			$table->string('created_by',20);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employees');
	}

}
