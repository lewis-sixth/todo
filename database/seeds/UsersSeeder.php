<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 6)->create()->each(function ($user) {
            factory(\App\Task::class, rand(1, 4))->create([
                'user_id' => $user->id
            ]);
        });
    }
}
