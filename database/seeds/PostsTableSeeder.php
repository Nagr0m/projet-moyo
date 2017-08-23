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
        # Suppression des images uploadées
        $uploads = public_path('img/posts/');

        for ($i = 0; $i < 10; $i++)
        {   
            $imgName = str_random(12) . '.jpg';
            $distImg = file_get_contents($faker->imageUrl());
            $Img = Image::make($distImg)->resize(env('THUMBNAIL_SIZE', 800), env('THUMBNAIL_SIZE', 800), function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            $Img->save($uploads . $imgName, 100);

            $Img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(200, 200)->save($uploads . 'square_' . $imgName, 100);

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
