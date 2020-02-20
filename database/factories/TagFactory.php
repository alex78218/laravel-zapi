<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'tagname' => $faker->word,
        'sort' => $faker->numberBetween(1, 10),
    ];
});
