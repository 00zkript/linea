<?php

namespace App\Console\Commands\Web;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AnularVentaTransferenciaComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anularventa:transferencia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Anular todas las ventas de que no han depositado el monto de su compra';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {

            $fechaHoraActual = now()->format('Y-m-d H:i:s');

            $ventas = DB::table('venta')
                ->where('fecha_hora_expiracion_transferencia','<',$fechaHoraActual)
                ->where('idventa_metodo_pago',1)
                ->where('idventa_pago_estado',3)
                ->where('estado',1)
                ->get();

            if (count($ventas) > 0) {

                foreach ($ventas AS $v){

                    $ventasDetalle = DB::table('venta_detalle')
                        ->where('idventa',$v->idventa)
                        ->get();

                    foreach ($ventasDetalle AS $vd){
                        $producto = Producto::find($vd->idproducto);
                        $producto->stock = $producto->stock + $vd->cantidad;
                        $producto->update();
                    }

                    $venta = Venta::find($v->idventa);
                    $venta->idventa_envio_estado = 3;
                    $venta->idventa_pago_estado = 4;
                    $venta->estado = 0;
                    $venta->update();

                    DB::table('voucher_venta')
                        ->where('idventa',$venta->idventa)
                        ->delete();

                }

                DB::commit();

                $this->alert("VENTA CANCELADA Y STOCK REPUESTO");

            }else{
                $this->alert("NO HAY VENTAS");
            }

        }catch (\Throwable $t){
            DB::rollBack();
            $this->alert($t->getMessage());
        }



    }
}
