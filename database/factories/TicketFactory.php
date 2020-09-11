<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->phoneNumber,
        'status' => rand(false, true),
        'title' => $faker->name,
        'body' => $faker->sentence(20),
        'image' => $faker->imageUrl(200, 200)
    ];
});
