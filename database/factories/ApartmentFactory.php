<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
    return [
        
        'name' => $faker->country,
        'active' => '1',
    ];
});
