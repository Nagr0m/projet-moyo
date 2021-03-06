<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Génère les articles d'exemple.
     *
     * @param Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {   
        $files = File::allFiles(public_path('img/posts'));
        foreach($files as $file) File::delete($file);
   
        File::copyDirectory(storage_path('app/exemplesImg'), public_path('img/posts'));
        $postsJSON = File::get(storage_path('data/posts.json'));
        $datas     = json_decode($postsJSON);

        foreach ($datas as $post)
        {
            $post = App\Post::create([
                'user_id'    => $post->user_id,
                'title'      => $post->title,
                'slug'       => $post->slug,
                'abstract'   => $post->abstract,
                'content'    => $post->content,
                'thumbnail'  => $post->thumbnail,
                'published'  => $post->published,
                'created_at' => $post->created_at
            ]);

            # Ajout de commentaires
            $nbComments = rand(0, 10);
            for ($j = 0; $j < $nbComments; $j++)
            {   
                $start = \Carbon\Carbon::createFromFormat('d/m/Y', $post->created_at);
                $commentdate = $faker->dateTimeBetween($start, 'now');
                $post->comments()->create([
                    'name'      => $faker->userName,
                    'content'   => $faker->text(),
                    'created_at'=> $commentdate
                ]);
            }
        }
    }
}
