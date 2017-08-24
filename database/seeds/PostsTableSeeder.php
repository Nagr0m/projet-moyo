<?php

use Illuminate\Database\Seeder;
use App\Repositories\PostImgRepository;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker, PostImgRepository $PostImgRepository)
    {   
        $files = File::allFiles(public_path('img/posts'));
        foreach($files as $file) File::delete($file);

        for ($i = 0; $i < 10; $i++)
        {   
            $distImg = file_get_contents($faker->imageUrl(1024, 720));
            $imgName = $PostImgRepository->saveThumbnail($distImg);

            $content = $faker->realText(400);
            $title   = $faker->realText(50);
            $date    = $faker->dateTimeBetween('-1 years', 'now');
            $post    = App\Post::create([
                'user_id'       => App\User::where('role', 'teacher')->limit(1)->get()[0]->id,
                'title'         => $title,
                'slug'          => str_slug($title),
                'abstract'      => Illuminate\Support\Str::words($content, 10),
                'content'       => $content,
                'thumbnail'     => $imgName,
                'published'     => true,
                'created_at'    => $date,
                'updated_at'    => $date,
            ]);

            # Ajout de commentaires
            $nbComments = rand(0, 10);
            for ($j = 0; $j < $nbComments; $j++)
            {
                $commentdate = $faker->dateTimeBetween($date, 'now');
                $post->comments()->create([
                    'name'      => $faker->userName,
                    'content'   => $faker->text(),
                    'published' => true,
                    'created_at'=> $commentdate,
                    'updated_at'=> $commentdate,
                ]);
            }
        }
    }
}
