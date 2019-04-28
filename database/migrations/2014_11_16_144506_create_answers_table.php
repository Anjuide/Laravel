<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	public function up()
	{
		Schema::create('answers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('poll_id')->unsigned();
			$table->string('answer');
			$table->integer('result');
		});
	}

	public function down()
	{
		Schema::drop('answers');
	}
}