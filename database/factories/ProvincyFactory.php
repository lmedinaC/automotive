<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Provincy;
use Faker\Generator as Faker;

$factory->define(Provincy::class, function (Faker $faker) {
    return [
        'name' => $faker->state,
        'active' => '1',
    ];
});