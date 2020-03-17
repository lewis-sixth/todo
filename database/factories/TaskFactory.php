<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(),
        'priority' => $faker->numberBetween(1, 10)
    ];
});
