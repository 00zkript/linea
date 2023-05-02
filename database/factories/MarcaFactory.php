<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Marca;
use Faker\Generator as Faker;

$factory->define(Marca::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->name,
        'descripcion' => $faker->text(100),
        'estado' => $faker->randomElement([1,0])
    ];
});
