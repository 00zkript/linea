<?php

namespace App\Exports\Panel;


use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class VentasExport implements FromView,ShouldAutoSize,WithColumnFormatting
{
    private $parametros;

    public function __construct($parametros)
    {
        $this->parametros = (Object) $parametros;
    }

    public function view(): View
    {
        $idmetodo_pago = $this->parametros->idmetodo_pago;
        $idestado_envio = $this->parametros->idestado_envio;
        $idestado_pago = $this->parametros->idestado_pago;
        $idestado_control_venta = $this->parametros->idestado_control_venta;
        $desde = $this->parametros->desde;
        $hasta = $this->parametros->hasta;

        $ventas = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "metodoPago", "estadoPago","cliente","moneda"])
            ->when(!empty($idestado_envio), function ($query) use ($idestado_envio) {
                return $query->where('idestado_envio', $idestado_envio);
            })
            ->when(!empty($idestado_pago), function ($query) use ($idestado_pago) {
                return $query->where('pago_idestado_pago', $idestado_pago);
            })
            ->when(!empty($idmetodo_pago), function ($query) use ($idmetodo_pago) {
                return $query->where('pago_idmetodo_pago', $idmetodo_pago);
            })
            ->when(!empty($idestado_control_venta), function ($query) use ($idestado_control_venta) {
                return $query->where('idestado_control_venta', $idestado_control_venta);
            })
            ->when(!empty($desde), function ($query) use ($desde) {
                $desdeFormat = now()->createFromFormat('d/m/Y', $desde)->format('Y-m-d');
                return $query->whereDate('fecha_venta', '>=', $desdeFormat);
            })
            ->when(!empty($hasta), function ($query) use ($hasta) {
                $hastaFormat = now()->createFromFormat('d/m/Y', $hasta)->format('Y-m-d');
                return $query->whereDate('fecha_venta', '<=', $hastaFormat);
            })
            ->where('estado',1)
            ->orderBy('fecha_venta', 'DESC')
            ->get();

        return view('panel.reporteVenta.excel.cuerpo')->with(compact('ventas'));
    }

    public function columnFormats(): array
    {
        return [
//            'G' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
//            'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
//            'I' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
        ];
    }


}
