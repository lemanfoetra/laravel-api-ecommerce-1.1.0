<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'name' => $faker->word,
        'price' => $faker->numberBetween('1000', '100000'),
        'stock'	=> $faker->numberBetween('1', '100'),
        'detail' => $faker->paragraph,
        'discount' => $faker->numberBetween('0', '99'),
    ];
});
