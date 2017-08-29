<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(Faker\Generator $faker)
	{
		$userJSON = File::get(storage_path('data/choices.json'));
		$datas    = json_decode($userJSON);

		for ($i = 0; $i < 10; $i++)
		{
			$date     = $faker->dateTimeBetween('-1 year');
			$question = App\Question::create([
				'title'			=> 'Exo-'.$i,
				'content'		=> $faker->realText(50),
				'class_level'	=> array_rand(['first_class' => '0', 'final_class' => '0']),
				'published'		=> 1,
				'created_at' 	=> $date
			]);

			for ($j=0; $j < rand(3,7); $j++) { 
				$choice = array_rand($datas);
				App\Choice::create([
					'question_id' 	=> $question->id,
					'content' 		=> $datas[$choice]->content,
					'answer' 		=> $datas[$choice]->answer,
					'created_at' 	=> $date
				]);
			}

			$students = App\User::select('id')->where('level', $question->class_level)->get();
			if (count($students) > 0) 
			{
				foreach ($students as $student)
				{   
					# Insère les données de score pour chaque étudiant
					App\Score::create([
						'user_id'     => $student->id,
						'question_id' => $question->id,
						'done'        => false,
						'created_at'  => $date
					]);
				}
			}
		}
	}
}
