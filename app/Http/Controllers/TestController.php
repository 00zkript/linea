<?php

namespace App\Http\Controllers;

use App\Mail\Panel\EstadoEnvioMail;
use App\Mail\Web\ComprobantePagoMail;
use App\User;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Distrito;
use App\Models\CostoEnvio;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\TipoDocumentoIdentidad;
use App\Mail\Web\VentaConfirmacionMail;
use App\Models\Carril;
use App\Models\Nivel;
use App\Models\NivelhasCarril;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Throwable;

class TestController extends Controller
{

    public function sessionAll(Request $request)
    {
       dd(session()->all());

    }

    public function sendConfirmVenta($idventa)
    {
        if (!$idventa ){
            return response()->json(['error'=>'No se encontro la venta'],404);
        }
        Mail::send(new VentaConfirmacionMail($idventa));

        return response()->json(['success'=>'Correo enviado']);
    }

    public function viewMailSales($idventa)
    {
        if (!$idventa ){
            return response()->json(['error'=>'No se encontro la venta'],404);
        }

        return new VentaConfirmacionMail($idventa);

    }

    public function viewMailStateSales($idventa)
    {
        if (!$idventa ){
            return response()->json(['error'=>'No se encontro la venta'],404);
        }

        return new EstadoEnvioMail($idventa);

    }

    public function quitarHtml()
    {
        $html = '
            <section class="container">
                <div id="steps" class="simulador">
                    <ul class="list-inline list-step-simulafacil text-center mt-4 mb-5">
                        <li class="list-inline-item" id="titleStep1">
                            <span class="circle">1</span>
                            <span><a href="#">Ver<br>carrito</a></span>
                        </li>
                        <li class="list-inline-item" id="titleStep2">
                            <span class="circle">2</span>
                            <span><a href="#">Información<br>del cliente</a></span>
                        </li>
                        <li class="active list-inline-item" id="titleStep3">
                            <span class="circle">3</span>
                            <span>Modo de<br>entrega</span>
                        </li>
                        <li class="list-inline-item" id="titleStep4">
                            <span class="circle">4</span>
                            <span>Método<br>de pago</span>
                        </li>

                    </ul>
                </div>
            </section>
        ';

        $html = preg_replace(
            ['/<(.*?)>/','/\n/','/\s+\s*/'],
            ['','',' '],
            $html
        );
        dd($html);
    }

    private function _getDistritosNuevos():array
    {
        return array(
        );
    }



    public function migrarPrecioEnvio()
    {

        $distritosNuevos = $this->_getDistritosNuevos();


        CostoEnvio::query()->truncate();

        $precioEnvio = new CostoEnvio();
        $precioEnvio->precio      = "15.00";
        $precioEnvio->descripcion = "tiempo de 1 a 5 dias hábiles";
        $precioEnvio->restriccion = "tiempo de 1 a 5 dias hábiles";
        $precioEnvio->estado      = 0;
        $precioEnvio->save();

        foreach ($distritosNuevos as $item) {
            $costoEnvio = new CostoEnvio();
            $costoEnvio->iddepartamento = 15;
            $costoEnvio->idprovincia    = 1501;
            $costoEnvio->iddistrito     = "1501".str_pad($item['id'], 2, "0", STR_PAD_LEFT);
            $costoEnvio->precio         = (float)($item["costo1"] + 2);
            $costoEnvio->descripcion    = "tiempo de 2 a 3 dias hábiles";
            $costoEnvio->restriccion    = "tiempo de 2 a 3 dias hábiles";
            $costoEnvio->estado         = 1;
            $costoEnvio->save();

        }

        return response()->json([
            'success' => true,
            'message' => 'Se crearon los precios de envio',
        ]);
    }


    public function testSend()
    {

        try{
            Mail::raw('Mensaje de prueba', function ($message) {
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
                ->to("desarrolloweb@dezain.com.pe")
                ->subject('CONFIRMACIÓN DE COMPRA');

            });


            return response()->json([
                "mensaje" => "Mensaje enviado",
            ]);

        }catch(Throwable $th){

            return response()->json([
                "mensaje" => "Mensaje no pudo ser enviado",
                "error" => $th->getMessage()
            ]);
        }
    }

    public function viewMailComprobantepago($idventa)
    {

        return new ComprobantePagoMail($idventa);

    }

    public function testPermission()
    {

        // Role::create(['name' => 'super-admin']);
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'Informe']);
        // Role::create(['name' => 'Caja']);

        $super = User::query()->find(1);
        $super->assignRole('super-admin');

        dd('done...');

    }


    public function rellenoNivelHasCarril()
    {

        NivelhasCarril::query()->truncate();
        foreach (Nivel::all() as $nivel) {
            foreach (Carril::all() as $carril) {
                $pivot = new NivelhasCarril();
                $pivot->idnivel = $nivel->idnivel;
                $pivot->idcarril = $carril->idcarril;
                $pivot->save();
            }
        }

        return ;
    }





}
