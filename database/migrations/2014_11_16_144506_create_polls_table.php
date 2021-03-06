<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePollsTable extends Migration {

	public function up()
	{
		Schema::create('polls', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('question');
		});
	}

	public function down()
	{
		Schema::drop('polls');
	}
}