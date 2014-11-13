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
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('login');
            $table->string('password');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->timestamps();
            $table->rememberToken();

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        //Schema::drop('workingon');
        //Schema::drop('users');
	}

}
