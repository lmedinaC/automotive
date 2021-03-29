<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Concessionaire;
use App\Model;
use Faker\Generator as Faker;


$factory->define(Concessionaire::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'active' => 1 ,
        'phone_number' => 999999999,
        'address'=> $faker->address,
        'district_id' => 1
         
    ];
});
