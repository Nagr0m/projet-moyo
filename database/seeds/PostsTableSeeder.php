<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {   
        for ($i = 0; $i < 10; $i++)
        {
            $content = $faker->realText(400);
            App\Post::create([
                'user_id'       => App\User::where('role', 'teacher')->limit(1)->get()[0]->id,
                'title'         => $faker->realText(50),
                'abstract'      => Illuminate\Support\Str::words($content, 10),
                'content'       => $content,
                'url_thumbnail' => $faker->imageUrl(),
                'published_at'  => Carbon\Carbon::now(),
                'published'     => true,
            ]);
        }
    }
}
