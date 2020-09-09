<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Brand;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName(),
        'desc' => $faker->sentence(20),
        'image' => $faker->imageUrl(300, 300)
    ];
});

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName(),
        'desc' => $faker->sentence(20),
        'image' => $faker->imageUrl(300, 300)
    ];
});
