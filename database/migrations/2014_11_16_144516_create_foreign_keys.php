<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('poll_id')->references('id')->on('polls')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('poll_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('poll_user', function(Blueprint $table) {
			$table->foreign('poll_id')->references('id')->on('polls')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_poll_id_foreign');
		});
		Schema::table('poll_user', function(Blueprint $table) {
			$table->dropForeign('poll_user_user_id_foreign');
		});
		Schema::table('poll_user', function(Blueprint $table) {
			$table->dropForeign('poll_user_poll_id_foreign');
		});
	}
}