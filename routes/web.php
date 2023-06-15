<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//Route::get('/test',function(){
//});

// Route::get('/test/enviar-confirmacion/{idventa}',[\App\Http\Controllers\TestController::class,'sendConfirmVenta']);
// Route::get('/test/ver-venta/{idventa}',[\App\Http\Controllers\TestController::class,'viewMailSales']);
// Route::get('/test/ver-estado-venta/{idventa}',[\App\Http\Controllers\TestController::class,'viewMailStateSales']);
// Route::get('/test/ver-comprobante-pago/{idventa}',[\App\Http\Controllers\TestController::class,'viewMailComprobantepago']);
// Route::get('/test/prueba-envio',[\App\Http\Controllers\TestController::class,'testSend']);
Route::get('/test/permissions',[\App\Http\Controllers\TestController::class,'testPermission']);


/* Route::get('/lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('lang');

Route::middleware(['translate'])->group(function () {

}); */

Route::redirect('/{url?}','/panel/login');







/*-----------------------------------------------------------------------*/

Route::get('/panel/login',[\App\Http\Controllers\Panel\LoginController::class,'index'])->name('panel.login.index');
Route::post('/panel/login/verificar',[\App\Http\Controllers\Panel\LoginController::class,'verificar'])->name('panel.login.verificar');
Route::get('/panel/login/salir',[\App\Http\Controllers\Panel\LoginController::class,'salir'])->name('panel.login.salir');




/* INICIO ----> RUTAS PROTEGIDAS USUARIO AUTENTICADO Y CON CARGO ADMINISTRADOR PARA ACCESO AL PANEL */
Route::middleware(['autenticado:panel',])->prefix("panel")->group(function (){

    Route::resource('inicio',\App\Http\Controllers\Panel\InicioController::class)->only(['index']);


    Route::resource('empresa',\App\Http\Controllers\Panel\EmpresaController::class)->only(['index','update']);

    Route::get('/configuracion',[\App\Http\Controllers\Panel\ConfiguracionController::class,'edit'])->name('configuracion.edit');
    Route::put('/configuracion/update',[\App\Http\Controllers\Panel\ConfiguracionController::class,'update'])->name('configuracion.update');

    Route::post('usuarios/habilitar',[\App\Http\Controllers\Panel\UsuarioController::class,'habilitar'])->name("usuario.habilitar");
    Route::post('usuarios/inhabilitar',[\App\Http\Controllers\Panel\UsuarioController::class,'inhabilitar'])->name("usuario.inhabilitar");
    Route::post('usuarios/listar',[\App\Http\Controllers\Panel\UsuarioController::class,'listar'])->name("usuario.listar");
    Route::resource('usuarios',\App\Http\Controllers\Panel\UsuarioController::class)->names('usuario');

    Route::put('moneda/{moneda}/habilitar',[\App\Http\Controllers\Panel\MonedaController::class,'habilitar'])->name("moneda.habilitar");
    Route::put('moneda/{moneda}/inhabilitar',[\App\Http\Controllers\Panel\MonedaController::class,'inhabilitar'])->name("moneda.inhabilitar");
    Route::get('moneda/listar',[\App\Http\Controllers\Panel\MonedaController::class,'listar'])->name("moneda.listar");
    Route::resource('moneda',\App\Http\Controllers\Panel\MonedaController::class);

    Route::get('cliente/{id}/provincias',[\App\Http\Controllers\Panel\ClienteController::class,'provincias'])->name("cliente.provincias");
    Route::get('cliente/{id}/distritos',[\App\Http\Controllers\Panel\ClienteController::class,'distritos'])->name("cliente.distritos");
    Route::post('cliente/habilitar',[\App\Http\Controllers\Panel\ClienteController::class,'habilitar'])->name("cliente.habilitar");
    Route::post('cliente/inhabilitar',[\App\Http\Controllers\Panel\ClienteController::class,'inhabilitar'])->name("cliente.inhabilitar");
    Route::post('cliente/listar',[\App\Http\Controllers\Panel\ClienteController::class,'listar'])->name("cliente.listar");
    Route::resource('cliente',\App\Http\Controllers\Panel\ClienteController::class);

    Route::post('empleado/habilitar',[\App\Http\Controllers\Panel\EmpleadoController::class,'habilitar'])->name("empleado.habilitar");
    Route::post('empleado/inhabilitar',[\App\Http\Controllers\Panel\EmpleadoController::class,'inhabilitar'])->name("empleado.inhabilitar");
    Route::post('empleado/listar',[\App\Http\Controllers\Panel\EmpleadoController::class,'listar'])->name("empleado.listar");
    Route::resource('empleado',\App\Http\Controllers\Panel\EmpleadoController::class);


    Route::get('matricula/resources',[\App\Http\Controllers\Panel\MatriculaController::class,'resources'])->name("matricula.resources");
    Route::get('matricula/{id}/provincias',[\App\Http\Controllers\Panel\MatriculaController::class,'provincias'])->name("matricula.provincias");
    Route::get('matricula/{id}/distritos',[\App\Http\Controllers\Panel\MatriculaController::class,'distritos'])->name("matricula.distritos");
    Route::post('matricula/crear-alumno',[\App\Http\Controllers\Panel\MatriculaController::class,'storeAlumno'])->name("matricula.storeAlumno");
    Route::get('matricula/cantidad-de-alumnos-matriculados',[\App\Http\Controllers\Panel\MatriculaController::class,'cantidadDeAlumnosMatriculados'])->name("matricula.cantidadDeAlumnosMatriculados");
    Route::post('matricula/guardar-matricula',[\App\Http\Controllers\Panel\MatriculaController::class,'storeMatricula'])->name("matricula.storeMatricula");

    Route::get('matricula/listar',[\App\Http\Controllers\Panel\MatriculaController::class,'listar'])->name("matricula.listar");
    Route::put('matricula/{idmatricula}/habilitar',[\App\Http\Controllers\Panel\MatriculaController::class,'habilitar'])->name("matricula.habilitar");
    Route::put('matricula/{idmatricula}/inhabilitar',[\App\Http\Controllers\Panel\MatriculaController::class,'inhabilitar'])->name("matricula.inhabilitar");
    Route::get('matricula/create/{id?}',[\App\Http\Controllers\Panel\MatriculaController::class,'create'])->name("matricula.create");

    Route::resource( 'matricula', \App\Http\Controllers\Panel\MatriculaController::class )->names('matricula')->only(['index','show']);


    Route::get('matricula-gym/listar',[\App\Http\Controllers\Panel\MatriculaGymController::class,'listar'])->name("matriculaGym.listar");
    Route::get('matricula-gym/resources',[\App\Http\Controllers\Panel\MatriculaGymController::class,'resources'])->name("matriculaGym.resources");
    Route::get('matricula-gym/{id}/provincias',[\App\Http\Controllers\Panel\MatriculaGymController::class,'provincias'])->name("matriculaGym.provincias");
    Route::get('matricula-gym/{id}/distritos',[\App\Http\Controllers\Panel\MatriculaGymController::class,'distritos'])->name("matriculaGym.distritos");
    Route::resource( 'matricula-gym', \App\Http\Controllers\Panel\MatriculaGymController::class )->names('matriculaGym');



    Route::get('pago/listar',[\App\Http\Controllers\Panel\PagoController::class,'listar'])->name("pago.listar");
    Route::get('pago/create/{idmatricula?}', [\App\Http\Controllers\Panel\PagoController::class, 'create'] )->name('pago.create');
    Route::resource( 'pago', \App\Http\Controllers\Panel\PagoController::class )->only(['index','store'])->names('pago');


    Route::get('historial-cambio',[\App\Http\Controllers\Panel\HistorialCambioMonedaController::class,'index'])->name("historialCambio.index");
    Route::get('historial-cambio/listado',[\App\Http\Controllers\Panel\HistorialCambioMonedaController::class,'listado'])->name("historialCambio.listado");
    // Route::resource( 'caja', \App\Http\Controllers\Panel\ArqueoCajaController::class )->only(['index','store'])->names('caja');


    Route::put('roles/{idrol}/habilitar',[\App\Http\Controllers\Panel\RolesController::class,'habilitar'])->name("panel.roles.habilitar");
    Route::put('roles/{idrol}/inhabilitar',[\App\Http\Controllers\Panel\RolesController::class,'inhabilitar'])->name("panel.roles.inhabilitar");
    Route::get('roles/listar',[\App\Http\Controllers\Panel\RolesController::class,'listar'])->name("panel.roles.listar");
    Route::resource('roles',\App\Http\Controllers\Panel\RolesController::class)->names('panel.roles');


    Route::post('arqueo-caja/abrir', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'abrir' ])->name('arqueoCaja.abrir');
    Route::post('arqueo-caja/cerrar', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'cerrar' ])->name('arqueoCaja.cerrar');









    // Route::post('example/file/store',[\App\Http\Controllers\Panel\ExampleController::class,'fileStore'])->name("example.file.store");
    // Route::post('example/file/update',[\App\Http\Controllers\Panel\ExampleController::class,'fileUpdate'])->name("example.file.update");
    // Route::post('example/file/sort',[\App\Http\Controllers\Panel\ExampleController::class,'fileSort'])->name("example.file.sort");
    // Route::post('example/file/destroy',[\App\Http\Controllers\Panel\ExampleController::class,'fileDestroy'])->name("example.file.destroy");
    // Route::put('example/{example}/habilitar',[\App\Http\Controllers\Panel\ExampleController::class,'habilitar'])->name("example.habilitar");
    // Route::put('example/{example}/inhabilitar',[\App\Http\Controllers\Panel\ExampleController::class,'inhabilitar'])->name("example.inhabilitar");
    // Route::get('example/listar',[\App\Http\Controllers\Panel\ExampleController::class,'listar'])->name("example.listar");
    // Route::resource('example',\App\Http\Controllers\Panel\ExampleController::class);





});
/* FIN ----> RUTAS PROTEGIDAS USUARIO AUTENTICADO Y CON CARGO ADMINISTRADOR PARA ACCESO AL PANEL */




/*
//Reoptimized class loader:
Route::get('/optimize-clear', function () {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>clear all cache</h1>';
});

Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

Route::get('/dump-autoload', function()
{
    system('composer dump-autoload');
    echo 'dump-autoload complete';
});
 */
