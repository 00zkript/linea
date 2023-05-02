<?php

namespace App\Http\Controllers\Web\Venta;

use App\Models\Venta;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\CostoEnvio;
use App\Models\PuntoVenta;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MetodoEntregaController extends Controller
{

    public function index()
    {
        $venta = Venta::query()->find(session()->get('idventa'));

        if (!$venta->idcliente){
            return redirect()->route('web.venta.usuario.index');
        }

        $departamentos = Departamento::query()->get();

        $provincias = '';
        if ($venta->iddepartamento){
            $provincias = Provincia::query()
                ->where("iddepartamento",$venta->iddepartamento)
                ->get();
        }

        $distritos = '';
        if ($venta->iddistrito){
            $distritos = Distrito::query()
                ->where("iddepartamento",$venta->iddepartamento)
                ->where("idprovincia",$venta->idprovincia)
                ->get();
        }

        $costoEnvio = '';
        if ($venta->idcosto_envio){

            $costoEnvio = CostoEnvio::query()
                ->where('idcosto_envio', $venta->idcosto_envio)
                ->orWhere(function($query) use ($venta){
                    $query->where('iddepartamento', $venta->iddepartamento)
                        ->where('idprovincia', $venta->idprovincia)
                        ->where('iddistrito', $venta->iddistrito);
                })
                ->where('estado', 1)
                ->get();

            if (count($costoEnvio) == 0){
                $costoEnvio = CostoEnvio::query()
                    ->whereNull(['iddepartamento', 'idprovincia', 'iddistrito'])
                    ->where('estado', 1)
                    ->get();
            }

        }

        $listPuntosVentas = PuntoVenta::query()
            ->where('estado',1)
            ->get();

        $isDelivery = !$venta->idmetodo_entrega || $venta->idmetodo_entrega == 1;



        return view('web.venta.metodoEntrega.index')->with(compact('venta','departamentos','provincias','distritos','costoEnvio','listPuntosVentas','isDelivery'));
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

        $iddepartamento = $request->input('iddepartamento');
        $idprovincia = $request->input('idprovincia');


        $distritos = Distrito::query()
            ->where('iddepartamento', $iddepartamento)
            ->where('idprovincia', $idprovincia)
            ->orderBy('nombre', 'ASC')
            ->get();


        return response()->json($distritos);


    }


    public function guardar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $metodoEntrega = $request->input('metodoEntrega');
        $idcosto_envio = $request->input('costoEnvio');
        $direccion     = $request->input('direccion');
        $referencia       = $request->input('referencia');
        $iddepartamento   = $request->input('departamento');
        $idprovincia      = $request->input('provincia');
        $iddistrito       = $request->input('distrito');
        $otroReceptor     = $request->input('otroReceptor');
        $nombreReceptor   = $request->input('nombreReceptor');
        $idpuntoVenta     = $request->input('puntoVenta');




        DB::beginTransaction();
        try {
            $costoEnvio = CostoEnvio::query()->find($idcosto_envio);

            session()->put('envio', [
                'iddepartamento' => $iddepartamento,
                'idprovincia' => $idprovincia,
                'iddistrito' => $iddistrito,
                'costoSeleccionado' => $costoEnvio,
            ]);


            $venta = Venta::query()->find(session()->get('idventa'));

            if ($metodoEntrega == 'domicilio'){

                $venta->idcosto_envio = $idcosto_envio;
                $venta->precio_envio = $costoEnvio->precio;
                $venta->idmetodo_entrega = 1;
                $venta->direccion        = $direccion;
                $venta->referencia       = $referencia;
                $venta->iddepartamento   = $iddepartamento;
                $venta->idprovincia      = $idprovincia;
                $venta->iddistrito       = $iddistrito;

            }

            if ($metodoEntrega == 'tienda'){
                session()->forget('envio');

                $venta->idpunto_venta = $idpuntoVenta;
                $venta->idcosto_envio = null;
                $venta->precio_envio = "0.00";
                $venta->idmetodo_entrega = 2;
                $venta->direccion        = null;
                $venta->referencia       = null;
                $venta->iddepartamento   = null;
                $venta->idprovincia      = null;
                $venta->iddistrito       = null;

            }

            $venta->otro_receptor = '';
            if ($otroReceptor){
                $venta->otro_receptor = $nombreReceptor;
            }

            $venta->total_final = ($venta->total - (float)$venta->descuento) + (float)$venta->precio_envio;

            $venta->update();



            DB::commit();

            return response()->json(["mensaje" => "La dirección se agregó satisfactoriamente."]);

        }catch (\Throwable $e){
            DB::rollBack();

            return response()->json([
                "mensaje" => "No se guardo la dirección,intente nuevamente.",
                "error" => $e->getMessage(),
            ],400);

        }
    }

    public function getPrecioEnvio(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        $iddepartamento = $request->input('iddepartamento');
        $idprovincia = $request->input('idprovincia');
        $iddistrito = $request->input('iddistrito');

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



        return response()->json($costosEnvio);

    }


}
