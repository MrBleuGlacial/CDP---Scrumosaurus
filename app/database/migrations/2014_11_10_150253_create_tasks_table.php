<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tasks', function($table)
        {
            $table->increments('id');
            $table->text('description');
            $table->integer('difficulty');
            $table->boolean('done');
            $table->boolean('in_progress');
            $table->integer('userstory_id');
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
