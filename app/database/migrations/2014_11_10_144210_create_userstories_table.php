<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserstoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('userstories', function($table)
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('sprint_id');
            $table->string('name');
            $table->integer('difficulty');
            $table->integer('priority');
            $table->text('description');
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
