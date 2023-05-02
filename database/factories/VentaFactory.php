<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Venta;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Venta::class, function (Faker $faker) {
    $totalYsubtotal = $faker->randomNumber(4);
    return [
        'idusuario' => User::all('idusuario')->random()->first()->idusuario,
        'idventa_metodo_pago' => DB::table('venta_metodo_pago')->select('idventa_metodo_pago')->inRandomOrder()->first()->idventa_metodo_pago,
        'idventa_envio_estado' => DB::table('venta_envio_estado')->select('idventa_envio_estado')->inRandomOrder()->first()->idventa_envio_estado,
        'idventa_pago_estado' => DB::table('venta_pago_estado')->select('idventa_pago_estado')->inRandomOrder()->first()->idventa_pago_estado,
        'iddepartamento' => DB::table('ubigeo_departamento')->select('iddepartamento')->inRandomOrder()->first()->iddepartamento,
        'idprovincia' => DB::table('ubigeo_provincia')->select('idprovincia')->inRandomOrder()->first()->idprovincia,
        'iddistrito' => DB::table('ubigeo_distrito')->select('iddistrito')->inRandomOrder()->first()->iddistrito,
        'direccion' => $faker->streetAddress,
        'telefono' => $faker->phoneNumber,
        'correo' => $faker->freeEmail,
        'nombres' => $faker->name,
        'apellidos' => $faker->lastName,
        'tipoDocumento' => $faker->randomElement(['DNI','CARNET EXTRANJERIA']),
        'numDocumento' => $faker->randomNumber(8),
        'tipoComprobante' => $faker->randomElement(['FACTURA','BOLETA']),
        'subtotal' => $totalYsubtotal,
        'total' => $totalYsubtotal,
        'fecha_venta' => $faker->date(),
        'hora_venta' => $faker->time(),
        'estado' => 1,
    ];
});
