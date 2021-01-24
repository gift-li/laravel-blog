<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        // 'author_id' => $faker->unique()->randomDigit(10),
        'title' => $faker->title(),
        'content' => $faker->paragraph()
    ];
});
