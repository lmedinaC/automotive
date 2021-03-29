<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\District;
use App\Model;
use Faker\Generator as Faker;

$factory->define(District::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'active' => '1',
    ];
});