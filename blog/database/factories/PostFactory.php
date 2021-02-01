<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'author_id' => rand(1, 10), // This is a simple and fine way to add foreign key constatints
        'title' => $faker->title,
        'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
