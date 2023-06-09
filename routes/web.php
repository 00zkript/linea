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
// Route::get('/test/permissions',[\App\Http\Controllers\TestController::class,'testPermission']);
// Route::get('/test/relleno-pivot-carril',[\App\Http\Controllers\TestController::class,'rellenoNivelHasCarril']);


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

    Route::put('usuarios/{idusuario}/habilitar',[\App\Http\Controllers\Panel\UsuarioController::class,'habilitar'])->name("usuario.habilitar");
    Route::put('usuarios/{idusuario}/inhabilitar',[\App\Http\Controllers\Panel\UsuarioController::class,'inhabilitar'])->name("usuario.inhabilitar");
    Route::get('usuarios/listar',[\App\Http\Controllers\Panel\UsuarioController::class,'listar'])->name("usuario.listar");
    Route::resource('usuarios',\App\Http\Controllers\Panel\UsuarioController::class)->names('usuario');


    Route::get('sucursal/ubigeo',[\App\Http\Controllers\Panel\SucursalController::class,'ubigeo'])->name("sucursal.ubigeo");
    Route::put('sucursal/{idsucursal}/habilitar',[\App\Http\Controllers\Panel\SucursalController::class,'habilitar'])->name("sucursal.habilitar");
    Route::put('sucursal/{idsucursal}/inhabilitar',[\App\Http\Controllers\Panel\SucursalController::class,'inhabilitar'])->name("sucursal.inhabilitar");
    Route::get('sucursal/listar',[\App\Http\Controllers\Panel\SucursalController::class,'listar'])->name("sucursal.listar");
    Route::resource('sucursal',\App\Http\Controllers\Panel\SucursalController::class);



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
    Route::get('matricula/resources/productos', [\App\Http\Controllers\Panel\MatriculaController::class, 'productos'] )->name('matricula.resources.productos');
    Route::get('matricula/resources/{idmatricula}/matricula',[\App\Http\Controllers\Panel\MatriculaController::class,'matricula'])->name("matricula.resources.matricula");
    Route::get('matricula/resources/{idcliente}/alumno',[\App\Http\Controllers\Panel\MatriculaController::class,'alumno'])->name("matricula.resources.alumno");
    Route::get('matricula/resources/{iddepartamento}/provincias',[\App\Http\Controllers\Panel\MatriculaController::class,'provincias'])->name("matricula.resources.provincias");
    Route::get('matricula/resources/{idprovincia}/distritos',[\App\Http\Controllers\Panel\MatriculaController::class,'distritos'])->name("matricula.resources.distritos");
    Route::get('matricula/resources/{idprograma}/niveles',[\App\Http\Controllers\Panel\MatriculaController::class,'niveles'])->name("matricula.resources.niveles");
    Route::get('matricula/resources/{idprograma}/frecuencias',[\App\Http\Controllers\Panel\MatriculaController::class,'frecuencias'])->name("matricula.resources.frecuencias");
    Route::get('matricula/resources/{idnivel}/carriles',[\App\Http\Controllers\Panel\MatriculaController::class,'carriles'])->name("matricula.resources.carriles");
    Route::get('matricula/resources/cantidad-de-alumnos-matriculados',[\App\Http\Controllers\Panel\MatriculaController::class,'cantidadDeAlumnosMatriculados'])->name("matricula.resources.cantidadDeAlumnosMatriculados");

    Route::get('matricula/create/{id?}',[\App\Http\Controllers\Panel\MatriculaController::class,'create'])->name("matricula.create");
    Route::post('matricula/actualizar-datos-alumno',[\App\Http\Controllers\Panel\MatriculaController::class,'storeAlumno'])->name("matricula.storeAlumno");
    Route::post('matricula/crear-matricula',[\App\Http\Controllers\Panel\MatriculaController::class,'storeMatricula'])->name("matricula.storeMatricula");
    Route::post('matricula/editar-matricula',[\App\Http\Controllers\Panel\MatriculaController::class,'updateMatricula'])->name("matricula.updateMatricula");

    Route::get('matricula/listar',[\App\Http\Controllers\Panel\MatriculaController::class,'listar'])->name("matricula.listar");
    Route::put('matricula/{idmatricula}/habilitar',[\App\Http\Controllers\Panel\MatriculaController::class,'habilitar'])->name("matricula.habilitar");
    Route::put('matricula/{idmatricula}/inhabilitar',[\App\Http\Controllers\Panel\MatriculaController::class,'inhabilitar'])->name("matricula.inhabilitar");
    Route::resource( 'matricula', \App\Http\Controllers\Panel\MatriculaController::class )->names('matricula')->only(['index','show', 'edit']);



    Route::get('matricula-gym/listar',[\App\Http\Controllers\Panel\MatriculaGymController::class,'listar'])->name("matriculaGym.listar");
    Route::get('matricula-gym/resources',[\App\Http\Controllers\Panel\MatriculaGymController::class,'resources'])->name("matriculaGym.resources");
    Route::get('matricula-gym/{id}/provincias',[\App\Http\Controllers\Panel\MatriculaGymController::class,'provincias'])->name("matriculaGym.provincias");
    Route::get('matricula-gym/{id}/distritos',[\App\Http\Controllers\Panel\MatriculaGymController::class,'distritos'])->name("matriculaGym.distritos");
    Route::resource( 'matricula-gym', \App\Http\Controllers\Panel\MatriculaGymController::class )->names('matriculaGym');



    Route::get('venta/resources/{idtipo_facturacion}/factura-serie', [\App\Http\Controllers\Panel\VentaController::class, 'facturaSerie'] )->name('venta.resources.facturaSerie');
    Route::get('venta/resources/productos', [\App\Http\Controllers\Panel\VentaController::class, 'productos'] )->name('venta.resources.productos');
    Route::get('venta/resources/matriculas', [\App\Http\Controllers\Panel\VentaController::class, 'matriculas'] )->name('venta.resources.matriculas');
    Route::get('venta/resources/clientes', [\App\Http\Controllers\Panel\VentaController::class, 'clientes'] )->name('venta.resources.clientes');
    Route::get('venta/resources/{idcarrito}/carrito', [\App\Http\Controllers\Panel\VentaController::class, 'carrito'] )->name('venta.resources.carrito');
    Route::get('venta/create/{idcarrito?}', [\App\Http\Controllers\Panel\VentaController::class, 'create'] )->name('venta.create');
    Route::get('venta/listar',[\App\Http\Controllers\Panel\VentaController::class,'listar'])->name("venta.listar");
    Route::get('venta/ticket/{idventa}',[\App\Http\Controllers\Panel\VentaController::class,'ticket'])->name("venta.ticket");

    Route::post('venta/{idventa}/anular', [\App\Http\Controllers\Panel\VentaController::class, 'anular'] )->name('venta.anular');
    Route::resource( 'venta', \App\Http\Controllers\Panel\VentaController::class )->only(['index','store','edit', 'update','show'])->names('venta');


    Route::get('historial-cambio',[\App\Http\Controllers\Panel\HistorialCambioMonedaController::class,'index'])->name("historialCambio.index");
    Route::get('historial-cambio/listado',[\App\Http\Controllers\Panel\HistorialCambioMonedaController::class,'listado'])->name("historialCambio.listado");
    // Route::resource( 'caja', \App\Http\Controllers\Panel\ArqueoCajaController::class )->only(['index','store'])->names('caja');


    Route::put('roles/{idrol}/habilitar',[\App\Http\Controllers\Panel\RolesController::class,'habilitar'])->name("panel.roles.habilitar");
    Route::put('roles/{idrol}/inhabilitar',[\App\Http\Controllers\Panel\RolesController::class,'inhabilitar'])->name("panel.roles.inhabilitar");
    Route::get('roles/listar',[\App\Http\Controllers\Panel\RolesController::class,'listar'])->name("panel.roles.listar");
    Route::resource('roles',\App\Http\Controllers\Panel\RolesController::class)->names('panel.roles');


    Route::post('arqueo-caja/abrir', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'abrir' ])->name('arqueoCaja.abrir');
    Route::get('arqueo-caja/cerrar', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'cerrar' ])->name('arqueoCaja.cerrar');
    Route::post('arqueo-caja/guardar-cierre', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'cerrarStore' ])->name('arqueoCaja.cerrarStore');
    Route::get('arqueo-caja/reporte/pdf', [ \App\Http\Controllers\Panel\ArqueoCajaController::class, 'reportePdf' ])->name('arqueoCaja.reportePdf');
    Route::get('arqueo-caja/listar',[\App\Http\Controllers\Panel\ArqueoCajaController::class,'listar'])->name("arqueoCaja.listar");
    Route::resource('arqueo-caja', \App\Http\Controllers\Panel\ArqueoCajaController::class)->names('arqueoCaja')->only(['index','show']);


    Route::get('arqueo-caja-operaciones/listar',[\App\Http\Controllers\Panel\ArqueoCajaOperacionesController::class,'listar'])->name("arqueoCajaOperacion.listar");
    Route::resource('arqueo-caja-operaciones', \App\Http\Controllers\Panel\ArqueoCajaOperacionesController::class)->names('arqueoCajaOperacion')->only(['index','show','create','store']);


    Route::put('temporada/{temporada}/habilitar',[\App\Http\Controllers\Panel\TemporadaController::class,'habilitar'])->name("temporada.habilitar");
    Route::put('temporada/{temporada}/inhabilitar',[\App\Http\Controllers\Panel\TemporadaController::class,'inhabilitar'])->name("temporada.inhabilitar");
    Route::get('temporada/listar',[\App\Http\Controllers\Panel\TemporadaController::class,'listar'])->name("temporada.listar");
    Route::resource('temporada',\App\Http\Controllers\Panel\TemporadaController::class);

    Route::put('programa/{programa}/habilitar',[\App\Http\Controllers\Panel\ProgramaController::class,'habilitar'])->name("programa.habilitar");
    Route::put('programa/{programa}/inhabilitar',[\App\Http\Controllers\Panel\ProgramaController::class,'inhabilitar'])->name("programa.inhabilitar");
    Route::get('programa/listar',[\App\Http\Controllers\Panel\ProgramaController::class,'listar'])->name("programa.listar");
    Route::get('programa/posicion-maxima',[\App\Http\Controllers\Panel\ProgramaController::class,'posicionMaxima'])->name("programa.posicionMaxima");
    Route::resource('programa',\App\Http\Controllers\Panel\ProgramaController::class);

    Route::put('nivel/{nivel}/habilitar',[\App\Http\Controllers\Panel\NivelController::class,'habilitar'])->name("nivel.habilitar");
    Route::put('nivel/{nivel}/inhabilitar',[\App\Http\Controllers\Panel\NivelController::class,'inhabilitar'])->name("nivel.inhabilitar");
    Route::get('nivel/listar',[\App\Http\Controllers\Panel\NivelController::class,'listar'])->name("nivel.listar");
    Route::get('nivel/posicion-maxima',[\App\Http\Controllers\Panel\NivelController::class,'posicionMaxima'])->name("nivel.posicionMaxima");
    Route::resource('nivel',\App\Http\Controllers\Panel\NivelController::class);

    Route::put('carril/{carril}/habilitar',[\App\Http\Controllers\Panel\CarrilController::class,'habilitar'])->name("carril.habilitar");
    Route::put('carril/{carril}/inhabilitar',[\App\Http\Controllers\Panel\CarrilController::class,'inhabilitar'])->name("carril.inhabilitar");
    Route::get('carril/listar',[\App\Http\Controllers\Panel\CarrilController::class,'listar'])->name("carril.listar");
    Route::resource('carril',\App\Http\Controllers\Panel\CarrilController::class);

    Route::put('frecuencia/{frecuencia}/habilitar',[\App\Http\Controllers\Panel\FrecuenciaController::class,'habilitar'])->name("frecuencia.habilitar");
    Route::put('frecuencia/{frecuencia}/inhabilitar',[\App\Http\Controllers\Panel\FrecuenciaController::class,'inhabilitar'])->name("frecuencia.inhabilitar");
    Route::get('frecuencia/listar',[\App\Http\Controllers\Panel\FrecuenciaController::class,'listar'])->name("frecuencia.listar");
    Route::resource('frecuencia',\App\Http\Controllers\Panel\FrecuenciaController::class);

    Route::put('horario/{horario}/habilitar',[\App\Http\Controllers\Panel\HorarioController::class,'habilitar'])->name("horario.habilitar");
    Route::put('horario/{horario}/inhabilitar',[\App\Http\Controllers\Panel\HorarioController::class,'inhabilitar'])->name("horario.inhabilitar");
    Route::get('horario/listar',[\App\Http\Controllers\Panel\HorarioController::class,'listar'])->name("horario.listar");
    Route::resource('horario',\App\Http\Controllers\Panel\HorarioController::class);

    Route::put('cantidad-clases/{cantidadClases}/habilitar',[\App\Http\Controllers\Panel\CantidadClasesController::class,'habilitar'])->name("cantidadClases.habilitar");
    Route::put('cantidad-clases/{cantidadClases}/inhabilitar',[\App\Http\Controllers\Panel\CantidadClasesController::class,'inhabilitar'])->name("cantidadClases.inhabilitar");
    Route::get('cantidad-clases/listar',[\App\Http\Controllers\Panel\CantidadClasesController::class,'listar'])->name("cantidadClases.listar");
    Route::resource('cantidad-clases',\App\Http\Controllers\Panel\CantidadClasesController::class)->names('cantidadClases');





    Route::post('productos/file/store',[\App\Http\Controllers\Panel\ProductoController::class,'fileStore'])->name("producto.file.store");
    Route::post('productos/file/update',[\App\Http\Controllers\Panel\ProductoController::class,'fileUpdate'])->name("producto.file.update");
    Route::post('productos/file/sort',[\App\Http\Controllers\Panel\ProductoController::class,'fileSort'])->name("producto.file.sort");
    Route::post('productos/file/destroy',[\App\Http\Controllers\Panel\ProductoController::class,'fileDestroy'])->name("producto.file.destroy");
    Route::put('productos/{idproducto}/habilitar',[\App\Http\Controllers\Panel\ProductoController::class,'habilitar'])->name("producto.habilitar");
    Route::put('productos/{idproducto}/inhabilitar',[\App\Http\Controllers\Panel\ProductoController::class,'inhabilitar'])->name("producto.inhabilitar");
    Route::get('productos/listar',[\App\Http\Controllers\Panel\ProductoController::class,'listar'])->name("producto.listar");
    Route::resource('productos',\App\Http\Controllers\Panel\ProductoController::class)->names('producto');





    // Route::post('example/file/store',[\App\Http\Controllers\Panel\ExampleController::class,'fileStore'])->name("example.file.store");
    // Route::post('example/file/update',[\App\Http\Controllers\Panel\ExampleController::class,'fileUpdate'])->name("example.file.update");
    // Route::post('example/file/sort',[\App\Http\Controllers\Panel\ExampleController::class,'fileSort'])->name("example.file.sort");
    // Route::post('example/file/destroy',[\App\Http\Controllers\Panel\ExampleController::class,'fileDestroy'])->name("example.file.destroy");
    // Route::put('example/{idexample}/habilitar',[\App\Http\Controllers\Panel\ExampleController::class,'habilitar'])->name("example.habilitar");
    // Route::put('example/{idexample}/inhabilitar',[\App\Http\Controllers\Panel\ExampleController::class,'inhabilitar'])->name("example.inhabilitar");
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
