<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

  public function run()
	{
		for($i = 0; $i < 12; ++$i) {
			DB::table('users')->insert(
				[
					'name' => 'Nom' . $i,
					'email' => 'email' . $i . '@blop.fr',
					'password' => bcrypt('password' . $i),
					'admin' => rand(0, 1)
				]
			);
		}
	}
}