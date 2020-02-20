<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'catename' => $faker->word,
        'parent_id' => 0,
        'sort' => $faker->numberBetween(1, 10),
    ];
});
