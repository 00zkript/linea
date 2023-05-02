<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CarroRequest;
use App\Http\Traits\VentaHelperTrait;
use App\Models\Empresa;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarroController extends Controller
{
    use VentaHelperTrait;

    protected $cart;
    protected $empresa;

    public function __construct()
    {

        $this->cart = Cart::instance("productos");

    }

    public function index(Request $request)
    {

        $departamentos = Departamento::query()
            ->get();

        $provincias = Provincia::query()
            ->where('iddepartamento', session()->get('envio.iddepartamento'))
            ->get();

        $distritos = Distrito::query()
            ->where('idprovincia', session()->get('envio.idprovincia'))
            ->get();

        $totalNeto = $this->calcularTotal();
        $descuento = $this->getDescuento();

        $cart = $this->cart;


        return view('web.carro.index')->with(compact('cart', 'departamentos', 'provincias', 'distritos', 'totalNeto', 'descuento'));
    }

    public function listadoAjax(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $departamentos = Departamento::query()
            ->get();

        $provincias = Provincia::query()
            ->where('iddepartamento', session()->get('envio.iddepartamento'))
            ->get();

        $distritos = Distrito::query()
            ->where('idprovincia', session()->get('envio.idprovincia'))
            ->get();

        $totalNeto = $this->calcularTotal();
        $descuento = $this->getDescuento();

        $cart = $this->cart;

        return response()->json(view('web.carro.listado')->with(compact('cart', 'departamentos', 'provincias', 'distritos', 'totalNeto', 'descuento'))->render());


    }



    public function store(CarroRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idproducto      = $request->input('idproducto');
        $cantidad        = $request->input('cantidad') >= 1 ? $request->input('cantidad') : 1;
        $isValid = true;
        $cantidadPedida = $cantidad;


        $producto = Producto::query()
            ->where('idproducto', $idproducto)
            ->where('estado', 1)
            ->first();

        $stock = $producto->stock;
        $price = $producto->precio_promocional > 0 ? $producto->precio_promocional : $producto->precio;

        if ($producto->stock < $cantidadPedida ){
            $isValid = false;
        }

        foreach ($this->cart->content() as $itemCart) {
            $cantidadSumanda = $cantidad + $itemCart->qty;

            if ( $itemCart->id == $idproducto && $producto->stock < $cantidadSumanda) {
                $isValid = false;
                $cantidadPedida = $cantidadSumanda;
            }
        }

        if ( !$isValid ){
            return response()->json([
                "mensaje" => "El stock actual de este producto es de: ". $stock ." y la cantidad de $cantidadPedida no esta disponible."
            ], 400);
        }



        $this->cart->add([
            'id' => $producto->idproducto,
            'name' => $producto->nombre,
            'qty' => $cantidad,
            'price' => $price,
            'options' => [
            ]
        ])->associate(Producto::class);

        return response()->json([
            "mensaje" => "Producto agregado al carrito",
            "cantidadProductos" => $this->cart->count(),
            "miniaturaCarrito" => view('web.carro.carritoMiniatura')->render()
        ]);
    }

    public function update(CarroRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idcarrito  = $request->input('idcarrito');
        $idproducto = $request->input('idproducto');
        $cantidad   = $request->input('cantidad') >= 1 ? $request->input('cantidad') : 1;


        $producto = Producto::query()
            ->where('idproducto', $idproducto)
            ->where('estado', 1)
            ->first();

        if (!$producto){
            return response()->json([
                "mensaje" => 'Este producto no existe en nuestro inventario'
            ], 400);
        }


        if ($producto->stock < $cantidad) {
            return response()->json([
                "mensaje" => "El stock actual de este producto es de: ". $producto->stock ." y la cantidad de $cantidad no esta disponible."
            ], 400);
        }


        $this->cart->update($idcarrito, $cantidad);
        $cantidadProductos = $this->cart->count();

        if (session()->has('cupon')) {
            if ($this->calcularTotal() < session()->get('cupon')->montoMinimo) {
                session()->forget('cupon');
            }
        }

        return response()->json([
            "mensaje" => "Pedido modificado",
            "cantidadProductos" => $cantidadProductos,
            "miniaturaCarrito" => view('web.carro.carritoMiniatura')->render()
        ]);



    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idcarrito = $request->input('idcarrito');

        $this->cart->remove($idcarrito);
        $cantidadProductos = $this->cart->count();

        if (session()->has('cupon')) {
            if ($this->calcularTotal() < session()->get('cupon')->montoMinimo) {
                session()->forget('cupon');
            }
        }

        if ($this->cart->count() <= 0) {
            session()->forget('cupon');
            session()->forget('envio');
        }

        return response()->json([
            "mensaje" => "El producto se ha removido de su carrito.",
            "cantidadProductos" => $cantidadProductos,
            "miniaturaCarrito" => view('web.carro.carritoMiniatura')->render()
        ]);


    }


    public function getProvincia(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $iddepartamento = $request->input('iddepartamento');


        $provincias = Provincia::query()
            ->where('iddepartamento', $iddepartamento)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($provincias);


    }

    public function getDistrito(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idprovincia = $request->input('idprovincia');

        $distritos = Distrito::query()
            ->where('idprovincia', $idprovincia)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($distritos);


    }

    public function calcularCostoEnvio(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $request->validate([
            'iddepartamento' => 'required|exists:ubigeo_departamento,iddepartamento',
            'idprovincia' => 'required|exists:ubigeo_provincia,idprovincia',
            'iddistrito' => 'required|exists:ubigeo_distrito,iddistrito',
        ], [], [
            'iddepartamento' => 'departamento',
            'idprovincia' => 'provincia',
            'iddistrito' => 'distrito',
        ]);

        $iddepartamento = $request->input('iddepartamento');
        $idprovincia    = $request->input('idprovincia');
        $iddistrito     = $request->input('iddistrito');

        $costosEnvioGeneral = DB::table('costo_envio')
            ->whereNull(['iddepartamento', 'idprovincia', 'iddistrito'])
            ->where('estado', 1);

        $costosEnvio = DB::table('costo_envio')
            ->union($costosEnvioGeneral)
            ->where('iddepartamento', $iddepartamento)
            ->where('idprovincia', $idprovincia)
            ->where('iddistrito', $iddistrito)
            ->where('estado', 1)
            ->get();

        session()->forget('envio');

        session()->put('envio', [
            'iddepartamento' => $iddepartamento,
            'idprovincia' => $idprovincia,
            'iddistrito' => $iddistrito
        ]);

        if (count($costosEnvio) > 0) {

            foreach ($costosEnvio as $c) {
                session()->push('envio.costosEnvio', $c);
            }


        }

        return response()->json($costosEnvio);


    }

    public function aplicarCostoEnvio(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $request->validate([
            'idcosto_envio' => 'required|exists:costo_envio,idcosto_envio'
        ], [], [
            'idcosto_envio' => 'Método de envio'
        ]);

        $idcosto_envio = $request->input('idcosto_envio');

        $costoEnvio = DB::table('costo_envio')
            ->where('idcosto_envio', $idcosto_envio)
            ->where('estado', 1)
            ->first();

        if (!$costoEnvio) {
            return response()->json([
                "mensaje" => "Esta opcion no esta disponible"
            ], 400);
        }


        session()->put('envio.costoSeleccionado', $costoEnvio);

        return response()->json([
            "mensaje" => 'Método de envio aplicado con exito.'
        ]);


    }

    public function resumenPagoCarrito(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cart = $this->cart;
        $totalNeto = $this->calcularTotal();

        $departamentos = Departamento::query()
            ->get();

        $provincias = Provincia::query()
            ->where('iddepartamento', session()->get('envio.iddepartamento'))
            ->get();

        $distritos = Distrito::query()
            ->where('idprovincia', session()->get('envio.idprovincia'))
            ->get();

        return view('web.carro.resumenPagoCarrito')->with(compact('cart','totalNeto', 'departamentos', 'provincias', 'distritos'))->render();
    }




    public function aplicarCupon(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $request->validate([
            'codigo' => 'required|exists:cupon,codigo',
        ], [
            'codigo.required' => 'Ingrese el código del cupón',
            'codigo.exists' => 'Este código de cupón no esta registrado en nuestro sistema'
        ]);

        $codigo = $request->input('codigo');
        $diaActual = now()->format('Y-m-d');

        $cupon = DB::table('cupon')
            ->where('codigo', $codigo)
            ->where('cantidad', '>=', 1)
            ->where('estado', 1)
            ->whereDate('fechaInicio', '<=', $diaActual)
            ->whereDate('fechaExpiracion', '>=', $diaActual)
            ->first();

        if (!$cupon){
            return response()->json([
                "mensaje" => 'Este cupón no esta disponible'
            ], 400);
        }

        session()->put('cupon', $cupon);
        $totalNeto = $this->calcularTotal();

        if ($totalNeto < $cupon->montoMinimo) {

            session()->forget('cupon');
            $empresaGeneral = Empresa::query()->first();
            $monedaGeneral = Moneda::query()->find($empresaGeneral->idmoneda);
            $total = $totalNeto * $monedaGeneral->cambio;

            $total = $monedaGeneral->simbolo.number_format( $total > 0 ? $total: "0.00",2,".","");
            $montoMinimo = $monedaGeneral->simbolo.number_format($cupon->montoMinimo * $monedaGeneral->cambio,2,".","");

            return response()->json([
                "mensaje" => "El monto estimado ($total) es menor al monto minimo del cupon ($montoMinimo). Por favor, aumente el monto de su compra para poder aplicar el cupón.",
            ], 400);
        }



        return response()->json([
            "mensaje" => 'El cupón se aplico con exito'
        ]);


    }

    public function removerCupon(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        session()->forget('cupon');

        return response()->json([
            "mensaje" => 'Cupon removido satisfactoriamente'
        ]);


    }



}
