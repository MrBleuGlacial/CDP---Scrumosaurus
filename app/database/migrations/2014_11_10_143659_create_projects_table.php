<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('projects', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('in_progress');
            $table->string('git');
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
