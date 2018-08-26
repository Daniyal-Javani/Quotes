<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => 0
    ];
});

$factory->state(App\Category::class, 'child', function ($faker) {
    return [
        'parent_id' => factory('App\Category')->create()->id,
    ];
});
