<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'idrol' => $faker->randomElement([1,2]),
        'usuario' => $faker->unique()->userName,
        'clave' => encrypt(123456),
        'nombres' => $faker->firstName("male"),
        'apellidos' => $faker->lastName,
        'correo' => $faker->unique()->email,
        'estado' => 1
    ];
});
