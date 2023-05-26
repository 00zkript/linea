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


    Route::get('/',[\App\Http\Controllers\Web\InicioController::class,'index'])->name('web.inicio');


    //Route::get('/pagina',[\App\Http\Controllers\Web\PaginaController::class,'index'])->name('web.pagina');
    Route::get('/pagina/{slug}',[\App\Http\Controllers\Web\PaginaController::class,'detalle'])->name('web.pagina.detalle');
    Route::get('/terminos-condiciones',[\App\Http\Controllers\Web\PaginaController::class,'terminosCondiciones'])->name('web.terminos-condiciones');
    Route::get('/politica-de-privacidad',[\App\Http\Controllers\Web\PaginaController::class,'politicaPrivacidad'])->name('web.politicas-privacidad');



    Route::post('/suscripcion/enviar',[\App\Http\Controllers\Web\SuscripcionController::class,'enviar'])->name('web.suscripcion.enviar');


    Route::get("/contacto",[\App\Http\Controllers\Web\ContactoController::class,'index'])->name('web.contacto');
    Route::post('/contacto/enviar',[\App\Http\Controllers\Web\ContactoController::class,'enviar'])->name('web.contacto.enviar');


    Route::get("/preguntas-frecuentes",[\App\Http\Controllers\Web\PreguntasFrecuentesController::class,'index'])->name('web.preguntas-frecuentes');


    Route::get('/blog', [\App\Http\Controllers\Web\BlogController::class,'index'])->name('web.blog');
    Route::get('/blog/{slug}', [\App\Http\Controllers\Web\BlogController::class,'detalle'])->name('web.blog.detalle');

    Route::get('/libro-de-reclamaciones',[\App\Http\Controllers\Web\LibroReclamacionController::class,'index'])->name('web.libro-reclamacion');
    Route::post('/libro-de-reclamaciones/guardarDatos',[\App\Http\Controllers\Web\LibroReclamacionController::class,'guardarDatos'])->name('web.libro-reclamacion.guardarDatos');


    Route::get('/asesores-comerciales',[\App\Http\Controllers\Web\AsesorController::class,'index'])->name('web.asesor');






    Route::get('/productos',[\App\Http\Controllers\Web\ProductoController::class,'index'])->name('web.productos');
    Route::get('/productos/buscar/{buscadorGlobal?}',[\App\Http\Controllers\Web\ProductoController::class,'index'])->name('web.productos.buscadorGlobal');
    Route::get('/productos/categoria/{slugCategoria}',[\App\Http\Controllers\Web\ProductoController::class,'categoria'])->name('web.productos.categoria');
    Route::get('/productos/seccion/{slugSection}',[\App\Http\Controllers\Web\ProductoController::class,'section'])->name('web.productos.section');
    Route::get('/productos/marca/{slugMarca}',[\App\Http\Controllers\Web\ProductoController::class,'marca'])->name('web.productos.marca');
    Route::get('/productos/caracteristica/{slugAtributo}/{valor}',[\App\Http\Controllers\Web\ProductoController::class,'caracteristica'])->name('web.productos.caracteristica');


    Route::get('/producto/{slug}',[\App\Http\Controllers\Web\ProductoController::class,'detalle'])->name('web.productos.detalle');
    Route::post('/productos/ajax/listadoProductosAjax',[\App\Http\Controllers\Web\ProductoController::class,'listadoProductosAjax'])->name('web.productos.listadoProductosAjax');
    Route::post('/productos/ajax/cambiarPresentacion',[\App\Http\Controllers\Web\ProductoController::class,'cambiarPresentacion'])->name('web.productos.cambiarPresentacion');
    Route::post('/productos/ajax/buscadorGlobalAjax',[\App\Http\Controllers\Web\ProductoController::class,'buscadorGlobalAjax'])->name('web.productos.buscadorGlobalAjax');




    Route::get("/favoritos",[\App\Http\Controllers\Web\FavoritoController::class,'index'])->name('web.favorito');
    Route::post('/favoritos/listado',[\App\Http\Controllers\Web\FavoritoController::class,'listado'])->name('web.favorito.listado');
    Route::post('/favorito/agregar',[\App\Http\Controllers\Web\FavoritoController::class,"agregar"])->name("web.favorito.agregar");
    Route::post('/favorito/eliminar',[\App\Http\Controllers\Web\FavoritoController::class,"eliminar"])->name("web.favorito.eliminar");


    Route::post('/carrito-de-compras/removerCupon',[\App\Http\Controllers\Web\CarroController::class,'removerCupon'])->name('web.carrito-de-compras.removerCupon');
    Route::post('/carrito-de-compras/aplicarCupon',[\App\Http\Controllers\Web\CarroController::class,'aplicarCupon'])->name('web.carrito-de-compras.aplicarCupon');

    Route::post('/carrito-de-compras/getProvincia',[\App\Http\Controllers\Web\CarroController::class,'getProvincia'])->name('web.carrito-de-compras.getProvincia');
    Route::post('/carrito-de-compras/changeProvincia',[\App\Http\Controllers\Web\CarroController::class,'getDistrito'])->name('web.carrito-de-compras.changeProvincia');
    Route::post('/carrito-de-compras/aplicarCostoEnvio',[\App\Http\Controllers\Web\CarroController::class,'aplicarCostoEnvio'])->name('web.carrito-de-compras.aplicarCostoEnvio');
    Route::post('/carrito-de-compras/calcularCostoEnvio',[\App\Http\Controllers\Web\CarroController::class,'calcularCostoEnvio'])->name('web.carrito-de-compras.calcularCostoEnvio');

    Route::post('/carrito-de-compras/listadoAjax',[\App\Http\Controllers\Web\CarroController::class,'listadoAjax'])->name('web.carrito-de-compras.listadoAjax');
    Route::post('/carrito-de-compras/resumenPagoCarrito',[\App\Http\Controllers\Web\CarroController::class,'resumenPagoCarrito'])->name('web.carrito-de-compras.resumenPagoCarrito');
    Route::resource('/carrito-de-compras',\App\Http\Controllers\Web\CarroController::class)->names('web.carrito-de-compras');



    Route::post('/mercadopago/verificar-pago', [\App\Http\Controllers\WebHook\PagoController::class, "verificarPago"])->name("mercadopago.verificarPago");
    Route::middleware(["validarIdventa"])->group(function (){
        Route::get('/resumen-pedido',[\App\Http\Controllers\Web\Venta\ResumenPedidoController::class,'index'])->name('web.venta.resumen');

        Route::get('/informacion-de-cliente',[\App\Http\Controllers\Web\Venta\DatosClienteController::class,'index'])->name('web.venta.usuario.index');
        Route::post('/informacion-de-cliente/guardar',[\App\Http\Controllers\Web\Venta\DatosClienteController::class,'guardar'])->name('web.venta.usuario.guardar');

        Route::get('/metodo-de-entrega',[\App\Http\Controllers\Web\Venta\MetodoEntregaController::class,'index'])->name('web.venta.entrega.index');
        Route::get('/metodo-de-entrega/getProvincia',[\App\Http\Controllers\Web\Venta\MetodoEntregaController::class,'getProvincia'])->name('web.venta.entrega.getProvincia');
        Route::get('/metodo-de-entrega/getDistrito',[\App\Http\Controllers\Web\Venta\MetodoEntregaController::class,'getDistrito'])->name('web.venta.entrega.getDistrito');
        Route::post('/metodo-de-entrega/getPrecioEnvio',[\App\Http\Controllers\Web\Venta\MetodoEntregaController::class,'getPrecioEnvio'])->name('web.venta.entrega.getPrecioEnvio');
        Route::post('/metodo-de-entrega/guardar',[\App\Http\Controllers\Web\Venta\MetodoEntregaController::class,'guardar'])->name('web.venta.entrega.guardar');



        Route::get('/metodo-de-pago',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'index'])->name('web.venta.pago.index');
        Route::get('/metodo-de-pago/verificarPedido',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'verificarPedido'])->name("web.venta.pago.verificarPedido");
        Route::post('/metodo-de-pago/pagarConTarjeta',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'pagarConTarjeta'])->name("web.venta.pago.pagarConTarjeta");
        Route::post('/metodo-de-pago/pagarConEfectivo',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'pagarConEfectivo'])->name("web.venta.pago.pagarConEfectivo");
        Route::post('/metodo-de-pago/pagarConDepositoBancario',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'pagarConDepositoBancario'])->name("web.venta.pago.pagarConDepositoBancario");
        /// IZIPAY
        // Route::post('/metodo-de-pago/createToken',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'createToken'])->name("web.venta.pago.createToken");
        // Route::post('/metodo-de-pago/confirmarPago',[\App\Http\Controllers\Web\Venta\MetodoPagoController::class,'confirmarPago'])->name("web.venta.pago.confirmarPago");

    });

    Route::get('/compra-finalizada',[\App\Http\Controllers\Web\Venta\FinalVentaController::class,'index'])->name("web.venta.finalVenta");



    Route::get('/login',[\App\Http\Controllers\Web\LoginController::class,'index'])->name('web.login');
    Route::post('/login/verificar',[\App\Http\Controllers\Web\LoginController::class,'verificar'])->name('web.login.verificar');

    Route::get('/registrarse',[\App\Http\Controllers\Web\LoginController::class,'registrase'])->name('web.login.registro');
    Route::post('/registrarse/guardar',[\App\Http\Controllers\Web\LoginController::class,'guardarUsuario'])->name('web.login.registro.guardar');

    Route::get('/recuperar-clave',[\App\Http\Controllers\Web\LoginController::class,'recuperarClave'])->name('web.login.recuperar-clave');
    Route::post('/recuperar-clave/enviarClave',[\App\Http\Controllers\Web\LoginController::class,'enviarClave'])->name('web.login.recuperar-clave.enviarClave');

    Route::get('/login/auth/{servicio}', [\App\Http\Controllers\Web\LoginController::class, 'loginAuth'])->name('web.login.auth');
    Route::get('/login/auth/return/facebook', [\App\Http\Controllers\Web\LoginController::class, 'responseLoginFacebook'])->name('web.login.facebook');
    Route::get('/login/auth/return/google', [\App\Http\Controllers\Web\LoginController::class, 'responseLoginGoogle'])->name('web.login.google');


    Route::get('/login/salir',[\App\Http\Controllers\Web\LoginController::class,'salir'])->name('web.login.salir');







    Route::middleware(['autenticado:web'])->group(function (){

        Route::get('/usuario/perfil',[\App\Http\Controllers\Web\UsuarioController::class,'index'])->name('web.usuario.index');
        Route::post('/usuario/modificarDatos',[\App\Http\Controllers\Web\UsuarioController::class,'modificarDatos'])->name('web.usuario.modificarDatos');
        Route::post('/usuario/listadoVentas',[\App\Http\Controllers\Web\UsuarioController::class,'listadoVentas'])->name('web.usuario.listadoVentas');
        Route::post('/usuario/detalleVenta',[\App\Http\Controllers\Web\UsuarioController::class,'detalleVenta'])->name('web.usuario.detalleVenta');
        Route::post('/usuario/updateComprobante',[\App\Http\Controllers\Web\UsuarioController::class,'updateComprobante'])->name('web.usuario.updateComprobante');


    });


}); */

Route::redirect('/{url?}','/panel/login');







/*-----------------------------------------------------------------------*/

Route::get('/panel/login',[\App\Http\Controllers\Panel\LoginController::class,'index'])->name('panel.login.index');
Route::post('/panel/login/verificar',[\App\Http\Controllers\Panel\LoginController::class,'verificar'])->name('panel.login.verificar');
Route::get('/panel/login/salir',[\App\Http\Controllers\Panel\LoginController::class,'salir'])->name('panel.login.salir');




/* INICIO ----> RUTAS PROTEGIDAS USUARIO AUTENTICADO Y CON CARGO ADMINISTRADOR PARA ACCESO AL PANEL */
Route::middleware(['autenticado:panel',])->prefix("panel")->group(function (){

    // Route::get('inicio/salesForMonth',[\App\Http\Controllers\Panel\InicioController::class,'salesForMonth'])->name('inicio.salesForMonth');
    // Route::get('inicio/getSalesForYearVsYearOld',[\App\Http\Controllers\Panel\InicioController::class,'getSalesForYearVsYearOld'])->name('inicio.getSalesForYearVsYearOld');
    // Route::get('inicio/getproductMostSelled',[\App\Http\Controllers\Panel\InicioController::class,'getproductMostSelled'])->name('inicio.getproductMostSelled');
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


    Route::get('matricula/listar',[\App\Http\Controllers\Panel\MatriculaController::class,'listar'])->name("matricula.listar");
    Route::get('matricula/resources',[\App\Http\Controllers\Panel\MatriculaController::class,'resources'])->name("matricula.resources");
    Route::get('matricula/{id}/provincias',[\App\Http\Controllers\Panel\MatriculaController::class,'provincias'])->name("matricula.provincias");
    Route::get('matricula/{id}/distritos',[\App\Http\Controllers\Panel\MatriculaController::class,'distritos'])->name("matricula.distritos");
    Route::resource( 'matricula', \App\Http\Controllers\Panel\MatriculaController::class )->names('matricula');


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










    // Route::get('costo-envio/getProvincia',[\App\Http\Controllers\Panel\CostoEnvioController::class,'getProvincia'])->name("costo-envio.getProvincia");
    // Route::get('costo-envio/getDistrito',[\App\Http\Controllers\Panel\CostoEnvioController::class,'getDistrito'])->name("costo-envio.getDistrito");
    // Route::post('costo-envio/habilitar',[\App\Http\Controllers\Panel\CostoEnvioController::class,'habilitar'])->name("costo-envio.habilitar");
    // Route::post('costo-envio/inhabilitar',[\App\Http\Controllers\Panel\CostoEnvioController::class,'inhabilitar'])->name("costo-envio.inhabilitar");
    // Route::post('costo-envio/listar',[\App\Http\Controllers\Panel\CostoEnvioController::class,'listar'])->name("costo-envio.listar");
    // Route::resource('costo-envio',\App\Http\Controllers\Panel\CostoEnvioController::class);

    // Route::post('asesores/habilitar',[\App\Http\Controllers\Panel\AsesorController::class,'habilitar'])->name("asesores.habilitar");
    // Route::post('asesores/inhabilitar',[\App\Http\Controllers\Panel\AsesorController::class,'inhabilitar'])->name("asesores.inhabilitar");
    // Route::post('asesores/listar',[\App\Http\Controllers\Panel\AsesorController::class,'listar'])->name("asesores.listar");
    // Route::resource('asesores',\App\Http\Controllers\Panel\AsesorController::class);

    // Route::post('marcas/habilitar',[\App\Http\Controllers\Panel\MarcaController::class,'habilitar'])->name("marcas.habilitar");
    // Route::post('marcas/inhabilitar',[\App\Http\Controllers\Panel\MarcaController::class,'inhabilitar'])->name("marcas.inhabilitar");
    // Route::post('marcas/listar',[\App\Http\Controllers\Panel\MarcaController::class,'listar'])->name("marcas.listar");
    // Route::resource('marcas',\App\Http\Controllers\Panel\MarcaController::class);

    // Route::get('categorias/getOrden',[\App\Http\Controllers\Panel\CategoriaController::class,'getOrden'])->name("categorias.getOrden");
    // Route::get('categorias/getParientes',[\App\Http\Controllers\Panel\CategoriaController::class,'getParientes'])->name("categorias.getParientes");
    // Route::post('categorias/habilitar',[\App\Http\Controllers\Panel\CategoriaController::class,'habilitar'])->name("categorias.habilitar");
    // Route::post('categorias/inhabilitar',[\App\Http\Controllers\Panel\CategoriaController::class,'inhabilitar'])->name("categorias.inhabilitar");
    // Route::post('categorias/listar',[\App\Http\Controllers\Panel\CategoriaController::class,'listar'])->name("categorias.listar");
    // Route::resource('categorias',\App\Http\Controllers\Panel\CategoriaController::class);

    // Route::get('menu/getPosicion',[\App\Http\Controllers\Panel\MenuController::class,'getPosicion'])->name("menu.getPosicion");
    // Route::get('menu/getParientes',[\App\Http\Controllers\Panel\MenuController::class,'getParientes'])->name("menu.getParientes");
    // Route::post('menu/habilitar',[\App\Http\Controllers\Panel\MenuController::class,'habilitar'])->name("menu.habilitar");
    // Route::post('menu/inhabilitar',[\App\Http\Controllers\Panel\MenuController::class,'inhabilitar'])->name("menu.inhabilitar");
    // Route::post('menu/listar',[\App\Http\Controllers\Panel\MenuController::class,'listar'])->name("menu.listar");
    // Route::post('menu/quitarIcono',[\App\Http\Controllers\Panel\MenuController::class,'quitarIcono'])->name("menu.quitarIcono");
    // Route::resource('menu',\App\Http\Controllers\Panel\MenuController::class);

    // Route::post('pagina/habilitar',[\App\Http\Controllers\Panel\PaginaController::class,'habilitar'])->name("pagina.habilitar");
    // Route::post('pagina/inhabilitar',[\App\Http\Controllers\Panel\PaginaController::class,'inhabilitar'])->name("pagina.inhabilitar");
    // Route::post('pagina/listar',[\App\Http\Controllers\Panel\PaginaController::class,'listar'])->name("pagina.listar");
    // Route::resource('pagina',\App\Http\Controllers\Panel\PaginaController::class);

    // Route::post('cupon/habilitar',[\App\Http\Controllers\Panel\CuponController::class,'habilitar'])->name("cupon.habilitar");
    // Route::post('cupon/inhabilitar',[\App\Http\Controllers\Panel\CuponController::class,'inhabilitar'])->name("cupon.inhabilitar");
    // Route::post('cupon/listar',[\App\Http\Controllers\Panel\CuponController::class,'listar'])->name("cupon.listar");
    // Route::resource('cupon',\App\Http\Controllers\Panel\CuponController::class);

    // Route::resource('seo',\App\Http\Controllers\Panel\SeoController::class)->only(['index','update']);
    // Route::resource('contacto',\App\Http\Controllers\Panel\ContactoController::class)->only(['index','update']);
    // Route::resource('terminos-condiciones',\App\Http\Controllers\Panel\TerminosCondicionesController::class)->only(['index','update']);
    // Route::resource('politicas-privacidad',\App\Http\Controllers\Panel\PoliticaPrivacidadController::class)->only(['index','update']);

    // Route::post('blog/habilitar',[\App\Http\Controllers\Panel\BlogController::class,'habilitar'])->name("blog.habilitar");
    // Route::post('blog/inhabilitar',[\App\Http\Controllers\Panel\BlogController::class,'inhabilitar'])->name("blog.inhabilitar");
    // Route::post('blog/listar',[\App\Http\Controllers\Panel\BlogController::class,'listar'])->name("blog.listar");
    // Route::resource('blog',\App\Http\Controllers\Panel\BlogController::class);

    // Route::post('blogCategoria/habilitar',[\App\Http\Controllers\Panel\BlogCategoriaController::class,'habilitar'])->name("blogCategoria.habilitar");
    // Route::post('blogCategoria/inhabilitar',[\App\Http\Controllers\Panel\BlogCategoriaController::class,'inhabilitar'])->name("blogCategoria.inhabilitar");
    // Route::post('blogCategoria/listar',[\App\Http\Controllers\Panel\BlogCategoriaController::class,'listar'])->name("blogCategoria.listar");
    // Route::resource('blogCategoria',\App\Http\Controllers\Panel\BlogCategoriaController::class);

    // Route::post('puntoVentas/habilitar',[\App\Http\Controllers\Panel\PuntoVentaController::class,'habilitar'])->name("puntoVentas.habilitar");
    // Route::post('puntoVentas/inhabilitar',[\App\Http\Controllers\Panel\PuntoVentaController::class,'inhabilitar'])->name("puntoVentas.inhabilitar");
    // Route::post('puntoVentas/listar',[\App\Http\Controllers\Panel\PuntoVentaController::class,'listar'])->name("puntoVentas.listar");
    // Route::resource('puntoVentas',\App\Http\Controllers\Panel\PuntoVentaController::class);

    // Route::get('banner/getPosicion',[\App\Http\Controllers\Panel\BannerController::class,'getPosicion'])->name("banner.getPosicion");
    // Route::post('banner/removerImagen',[\App\Http\Controllers\Panel\BannerController::class,'removerImagen'])->name("banner.removerImagen");
    // Route::post('banner/habilitar',[\App\Http\Controllers\Panel\BannerController::class,'habilitar'])->name("banner.habilitar");
    // Route::post('banner/inhabilitar',[\App\Http\Controllers\Panel\BannerController::class,'inhabilitar'])->name("banner.inhabilitar");
    // Route::post('banner/listar',[\App\Http\Controllers\Panel\BannerController::class,'listar'])->name("banner.listar");
    // Route::resource('banner',\App\Http\Controllers\Panel\BannerController::class);

    // Route::post('popup/cantidadPopups',[\App\Http\Controllers\Panel\PopupController::class,'cantidadPopups'])->name("popup.cantidadPopups");
    // Route::post('popup/removerImagen',[\App\Http\Controllers\Panel\PopupController::class,'removerImagen'])->name("popup.removerImagen");
    // Route::post('popup/habilitar',[\App\Http\Controllers\Panel\PopupController::class,'habilitar'])->name("popup.habilitar");
    // Route::post('popup/inhabilitar',[\App\Http\Controllers\Panel\PopupController::class,'inhabilitar'])->name("popup.inhabilitar");
    // Route::post('popup/listar',[\App\Http\Controllers\Panel\PopupController::class,'listar'])->name("popup.listar");
    // Route::resource('popup',\App\Http\Controllers\Panel\PopupController::class);

    // Route::get('ventas',[\App\Http\Controllers\Panel\VentaController::class,'index'])->name('ventas.index');
    // Route::post('ventas/listar',[\App\Http\Controllers\Panel\VentaController::class,'listar'])->name("ventas.listar");
    // Route::post('ventas/detalleVenta',[\App\Http\Controllers\Panel\VentaController::class,'detalleVenta'])->name("ventas.detalleVenta");
    // Route::post('ventas/detalleVoucher',[\App\Http\Controllers\Panel\VentaController::class,'detalleVoucher'])->name("ventas.detalleVoucher");
    // Route::post('ventas/anularVenta',[\App\Http\Controllers\Panel\VentaController::class,'anularVenta'])->name("ventas.anularVenta");
    // Route::post('ventas/modificarEstadoControlVenta',[\App\Http\Controllers\Panel\VentaController::class,'modificarEstadoControlVenta'])->name("ventas.modificarEstadoControlVenta");
    // Route::post('ventas/modificarEstadoEnvio',[\App\Http\Controllers\Panel\VentaController::class,'modificarEstadoEnvio'])->name("ventas.modificarEstadoEnvio");
    // Route::post('ventas/modificarEstadoPago',[\App\Http\Controllers\Panel\VentaController::class,'modificarEstadoPago'])->name("ventas.modificarEstadoPago");
    // Route::get('ventas/{venta}/pdf',[\App\Http\Controllers\Panel\VentaController::class,'pdf'])->name('ventas.pdf');

    // Route::get('reporte-ventas',[\App\Http\Controllers\Panel\ReporteVentaController::class,'index'])->name('reporteVentas.index');
    // Route::post('reporte-ventas/generarPdfVentas',[\App\Http\Controllers\Panel\ReporteVentaController::class,'generarPdfVentas'])->name('reporteVentas.generarPdfVentas');
    // Route::post('reporte-ventas/generarExcelVentas',[\App\Http\Controllers\Panel\ReporteVentaController::class,'generarExcelVentas'])->name('reporteVentas.generarExcelVentas');

    // Route::post('productos/imagen/upload',[\App\Http\Controllers\Panel\ProductoController::class,'imagenUpload'])->name("productos.imagen.upload");
    // Route::post('productos/imagen/update',[\App\Http\Controllers\Panel\ProductoController::class,'imagenUpdate'])->name("productos.imagen.update");
    // Route::post('productos/imagen/sort',[\App\Http\Controllers\Panel\ProductoController::class,'imagenSort'])->name("productos.imagen.sort");
    // Route::post('productos/imagen/remove',[\App\Http\Controllers\Panel\ProductoController::class,'imagenRemove'])->name("productos.imagen.remove");
    // Route::post('productos/manual/upload',[\App\Http\Controllers\Panel\ProductoController::class,'manualUpload'])->name("productos.manual.upload");
    // Route::post('productos/manual/update',[\App\Http\Controllers\Panel\ProductoController::class,'manualUpdate'])->name("productos.manual.update");
    // Route::post('productos/manual/remove',[\App\Http\Controllers\Panel\ProductoController::class,'manualRemove'])->name("productos.manual.remove");
    // Route::post('productos/importarProductos',[\App\Http\Controllers\Panel\ProductoController::class,'importarProductos'])->name("productos.importarProductos");
    // Route::get('productos/getResources',[\App\Http\Controllers\Panel\ProductoController::class,'getResources'])->name("productos.getResources");
    // Route::get('producto/getProductos',[\App\Http\Controllers\Panel\ProductoController::class,'getProductos'])->name('producto.getProductos');
    // Route::post('productos/habilitar',[\App\Http\Controllers\Panel\ProductoController::class,'habilitar'])->name("productos.habilitar");
    // Route::post('productos/inhabilitar',[\App\Http\Controllers\Panel\ProductoController::class,'inhabilitar'])->name("productos.inhabilitar");
    // Route::post('productos/listar',[\App\Http\Controllers\Panel\ProductoController::class,'listar'])->name("productos.listar");
    // Route::resource('productos',\App\Http\Controllers\Panel\ProductoController::class);

    // Route::post('preguntas-frecuentes/habilitar',[\App\Http\Controllers\Panel\PreguntaFrecuenteController::class,'habilitar'])->name("preguntas-frecuentes.habilitar");
    // Route::post('preguntas-frecuentes/inhabilitar',[\App\Http\Controllers\Panel\PreguntaFrecuenteController::class,'inhabilitar'])->name("preguntas-frecuentes.inhabilitar");
    // Route::post('preguntas-frecuentes/listar',[\App\Http\Controllers\Panel\PreguntaFrecuenteController::class,'listar'])->name("preguntas-frecuentes.listar");
    // Route::resource('preguntas-frecuentes',\App\Http\Controllers\Panel\PreguntaFrecuenteController::class);

    // Route::get('suscripcion/downloadExcel',[\App\Http\Controllers\Panel\SuscripcionController::class,'downloadExcel'])->name("suscripcion.downloadExcel");
    // Route::post('suscripcion/listar',[\App\Http\Controllers\Panel\SuscripcionController::class,'listar'])->name("suscripcion.listar");
    // Route::resource('suscripcion',\App\Http\Controllers\Panel\SuscripcionController::class)->only(['index']);

    // Route::put('seccion/{seccion}/habilitar',[\App\Http\Controllers\Panel\SectionController::class,'habilitar'])->name("section.habilitar");
    // Route::put('seccion/{seccion}/inhabilitar',[\App\Http\Controllers\Panel\SectionController::class,'inhabilitar'])->name("section.inhabilitar");
    // Route::get('seccion/listar',[\App\Http\Controllers\Panel\SectionController::class,'listar'])->name("section.listar");
    // Route::get('seccion/total-secciones',[\App\Http\Controllers\Panel\SectionController::class,'getCountSection'])->name("section.getCountSection");
    // Route::resource('seccion',\App\Http\Controllers\Panel\SectionController::class)->names('section');

    // Route::post('atributo/file/destroy',[\App\Http\Controllers\Panel\AtributoController::class,'fileDestroy'])->name("atributo.file.destroy");
    // Route::put('atributo/{atributo}/habilitar',[\App\Http\Controllers\Panel\AtributoController::class,'habilitar'])->name("atributo.habilitar");
    // Route::put('atributo/{atributo}/inhabilitar',[\App\Http\Controllers\Panel\AtributoController::class,'inhabilitar'])->name("atributo.inhabilitar");
    // Route::get('atributo/listar',[\App\Http\Controllers\Panel\AtributoController::class,'listar'])->name("atributo.listar");
    // Route::resource('atributo',\App\Http\Controllers\Panel\AtributoController::class);

    // Route::get('seccion-home/getSections',[\App\Http\Controllers\Panel\SectionHomeController::class,'getSections'])->name("section-home.getSections");
    // Route::resource('seccion-home',\App\Http\Controllers\Panel\SectionHomeController::class)->only(['index','store','update','destroy'])->names('section-home');

    // Route::put('testimonio/{example}/habilitar',[\App\Http\Controllers\Panel\TestimonioController::class,'habilitar'])->name("testimonio.habilitar");
    // Route::put('testimonio/{example}/inhabilitar',[\App\Http\Controllers\Panel\TestimonioController::class,'inhabilitar'])->name("testimonio.inhabilitar");
    // Route::get('testimonio/listar',[\App\Http\Controllers\Panel\TestimonioController::class,'listar'])->name("testimonio.listar");
    // Route::resource('testimonio',\App\Http\Controllers\Panel\TestimonioController::class);

    // Route::put('instagram/{instagram}/habilitar',[\App\Http\Controllers\Panel\InstagramController::class,'habilitar'])->name("instagram.habilitar");
    // Route::put('instagram/{instagram}/inhabilitar',[\App\Http\Controllers\Panel\InstagramController::class,'inhabilitar'])->name("instagram.inhabilitar");
    // Route::get('instagram/listar',[\App\Http\Controllers\Panel\InstagramController::class,'listar'])->name("instagram.listar");
    // Route::resource('instagram',\App\Http\Controllers\Panel\InstagramController::class);













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
