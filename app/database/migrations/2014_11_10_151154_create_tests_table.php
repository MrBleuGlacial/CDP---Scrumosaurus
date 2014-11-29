<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tests', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('description');
            $table->text('result');
            $table->boolean('works');
            $table->integer('userstory_id');
            $table->dateTime('date')->nullable();
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
		//
	}

}
