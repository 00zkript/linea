<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Categoria;
use Faker\Generator as Faker;

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'pariente' => $faker->numberBetween(1,200),
        'nombre' => $faker->unique()->name,
        'nivel' => $faker->numberBetween(1,2),
        'orden' => $faker->numberBetween(1,200),
        'descripcion' => $faker->text(100),
        'estado' => $faker->randomElement([0,1])
    ];
});
