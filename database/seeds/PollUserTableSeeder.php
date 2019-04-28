<?php

use Illuminate\Database\Seeder;

class PollUserTableSeeder extends Seeder {

  public function run()
	{
		for($i = 1; $i < 11; $i++) {
			DB::table('poll_user')->insert(
				[
					['poll_id' => 1, 'user_id' => $i],
					['poll_id' => 2, 'user_id' => $i],
					['poll_id' => 3, 'user_id' => $i],
					['poll_id' => 5, 'user_id' => $i]
				]
			);
		}
	}
}