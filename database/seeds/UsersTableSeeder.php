<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $userJSON = File::get(storage_path('data/users.json'));
        $datas    = json_decode($userJSON);

        foreach ($datas as $user)
        {
            App\User::create([
                'username' => $user->username,
                'email'    => $faker->email,
                'password' => bcrypt('secret'),
                'role'     => $user->role,
                'level'    => ($user->level) ?: null,
            ]);
        }
    }
}
