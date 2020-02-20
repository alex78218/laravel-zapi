<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 20),
        'title' => $faker->sentence,
        'category_id' => $faker->numberBetween(1, 10),
        'content' => $faker->paragraph,
        'views' => $faker->numberBetween(0,200)
    ];
});
