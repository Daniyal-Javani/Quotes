<?php

use Faker\Generator as Faker;


$factory->define(App\Quote::class, function (Faker $faker) {

$categoryIds = App\Category::all()->pluck('id')->toArray();

    return [
        'text' => $faker->paragraph,
        'user_id' => factory(App\User::class)->create()->id,
        'author_id' => factory(App\Author::class)->create()->id,
        'category_id' => $faker->randomElement($categoryIds)
    ];
});
