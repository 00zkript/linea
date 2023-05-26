<?php

use Faker\Guesser\Name;
use Illuminate\Support\Str;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->describe('Display an inspiring quote');


// Artisan::command('test',function () {
//     print_r("este es un test");
//     // App\Jobs\TestJob::dispatch("1");
//     // return response("fin");
// })->describe('Job test');

// Artisan::command('test:test1',function () {
//     print_r("este es un test");
// })->describe('job sub comando');

/*
Artisan::command('comando:nombre {nombre} {--m= : Mensaje adicional} {--r : Realizar acción adicional}', function ($nombre) {
    $mensaje = $this->option('m');
    $realizarAccion = $this->option('r');

    $this->info("El nombre ingresado es: " . $nombre);

    if ($mensaje) {
        $this->info("Mensaje adicional: " . $mensaje);
    }

    if ($realizarAccion) {
        $this->info("Realizando acción adicional");
        // Lógica de la acción adicional
    }
})->describe('crear comando con parametros'); */

Artisan::command('create:permission {model} {--action= : Accion que realizara } {--alias= : Nombre custom para el alias del permiso} {--r : Agregar resources} {--all : Todos los permisos}', function ($model) {
    $realizarAccion = $this->option('r');
    $alias = $this->option('alias');
    $actionCustom = $this->option('action');
    $all = $this->option('all');

    $permssionResources = [
        'create' => 'Crear',
        'edit' => 'Editar',
        'enable' => 'Habilitar',
        'disable' => 'Inhabilitar',
        'destroy' => 'Eliminar',
        'manage' => 'Gestionar'
    ];


    if ($realizarAccion) {
        $alias = $alias ?: $model;

        foreach ( $permssionResources as $key => $action ) {
            $namePermission = "$model.$key";
            $aliasPermssion = "$action $alias";

            $permision = [ 'name' => $namePermission, 'alias' => $aliasPermssion];
            Spatie\Permission\Models\Permission::create($permision);

            $this->info("Permiso \"$namePermission\" con el alias \"$aliasPermssion\" a sido creado correctamente.");
        }

        return;
    }


    $actionCustom = $actionCustom ?: Str::random(10);
    $alias = $alias ?: $model.".".Str::random(10);

    $namePermission = "$model.$actionCustom";
    $aliasPermssion = $alias;

    $permision = [ 'name' => $namePermission, 'alias' => $aliasPermssion];
    Spatie\Permission\Models\Permission::create($permision);
    $this->info("Permiso \"$namePermission\" con el alias \"$aliasPermssion\" a sido creado correctamente.");




    // ┌─────────────────┐
    // │ Test for comand │
    // └─────────────────┘
    // Name => model + acttion
    // Alias => descripcion en español

    // php artisan create:permission alumno --alias="Create Alumno" --action="create"
    // php artisan create:permission alumno --alias="Create Alumno"
    // php artisan create:permission alumno --alias="Alumno" --r
    // php artisan create:permission alumno --r


})->describe('crear permiso con parametros');
