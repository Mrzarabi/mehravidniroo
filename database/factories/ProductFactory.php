<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName(),
        'desc' => $faker->paragraph(150),
        'body' => $faker->paragraph(150),
        // 'image' => $faker->imageUrl(300, 300),
        'u_price' => $faker->numberBetween(10000, 100000),
        'c_price' => $faker->numberBetween(10000, 100000),
        'inventory' => $faker->numberBetween(10000, 100000)
    ];
});
