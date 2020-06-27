<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $name = $faker->sentence;

    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'description' => $faker->paragraph,
        'picture' => $faker->imageUrl(800, 533),
    ];
});
