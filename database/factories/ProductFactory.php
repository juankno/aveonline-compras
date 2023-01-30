<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => User::where('role_id', User::ROLES['user'])->inRandomOrder()->first()->id,
    ];
});
