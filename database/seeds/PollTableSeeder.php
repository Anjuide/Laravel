<?php

use Illuminate\Database\Seeder;

class PollTableSeeder extends Seeder {

  public function run()
	{
		DB::table('polls')->insert(
			[
				['question' => 'Que pensez-vous de ce site ?'],
				['question' => 'Quel est votre langage préféré ?'],
				['question' => 'Quelle est votre couleur préférée ?'],
				['question' => 'Quel est votre âge ?'],
				['question' => 'Quel est votre animal favori ?']
			]
		);
	}
}