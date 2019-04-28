<?php

use Illuminate\Database\Seeder;

class AnswerTableSeeder extends Seeder {

  public function run()
	{
		DB::table('answers')->insert([
			[
				'poll_id' => 1,
				'answer' => 'Super !',
				'result' => 6
			],
			[
				'poll_id' => 1,
				'answer' => 'Moyen',
				'result' => 1
			],
			[
				'poll_id' => 1,
				'answer' => 'Nul !',
				'result' => 3
			],	
			[
				'poll_id' => 2,
				'answer' => 'PHP',
				'result' => 3
			],	
			[
				'poll_id' => 2,
				'answer' => 'C++',
				'result' => 2
			],
			[
				'poll_id' => 2,
				'answer' => 'Javascript',
				'result' => 2
			],	
			[
				'poll_id' => 2,
				'answer' => 'Java',
				'result' => 1
			],
			[
				'poll_id' => 2,
				'answer' => 'C#',
				'result' => 2
			],
			[
				'poll_id' => 3,
				'answer' => 'Rouge',
				'result' => 7
			],	
			[
				'poll_id' => 3,
				'answer' => 'Vert',
				'result' => 1
			],
			[
				'poll_id' => 3,
				'answer' => 'Bleu',
				'result' => 2
			],
			[
				'poll_id' => 4,
				'answer' => 'Moins de 30',
				'result' => 0
			],
			[
				'poll_id' => 4,
				'answer' => 'Entre 30 et 40',
				'result' => 0
			],
			[
				'poll_id' => 4,
				'answer' => 'Entre 40 et 50',
				'result' => 0
			],
			[
				'poll_id' => 4,
				'answer' => 'Plus de 50',
				'result' => 0
			],
			[
				'poll_id' => 5,
				'answer' => 'Chat',
				'result' => 4
			],
			[
				'poll_id' => 5,
				'answer' => 'Chien',
				'result' => 3
			],
			[
				'poll_id' => 5,
				'answer' => 'Souris',
				'result' => 0
			],
			[
				'poll_id' => 5,
				'answer' => 'Tigre',
				'result' => 2
			],
			[
				'poll_id' => 5,
				'answer' => 'Eléphant',
				'result' => 1
			]
		]);
	}
}