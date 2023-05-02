<?php

namespace App\Http\Controllers\Panel;

use App\Exports\Panel\VentasExport;
use App\Http\Controllers\Controller;
use App\Models\EstadoControlVenta;
use App\Models\EstadoEnvio;
use App\Models\EstadoPago;
use App\Models\MetodoPago;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReporteVentaController extends Controller
{

    public function index(Request $request)
    {


        $estadosEnvio = EstadoEnvio::query()
            ->where('estado', 1)
            ->get();

        $estadosPago = EstadoPago::query()
            ->where('estado', 1)
            ->get();

        $metodosPago = MetodoPago::query()
            ->where('estado',1)
            ->get();

        $estadosControlVenta = EstadoControlVenta::query()
            ->where('estado', 1)
            ->get();


        return view('panel.reporteVenta.index')->with(compact('estadosEnvio', 'estadosPago', 'metodosPago', 'estadosControlVenta'));
    }

    public function generarPdfVentas(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json("Contenido no disponible", 404);
        }

        $idmetodo_pago = $request->input('idmetodo_pago');
        $idestado_envio = $request->input('idestado_envio');
        $idestado_pago = $request->input('idestado_pago');
        $idestado_control_venta = $request->input('idestado_control_venta');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

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


        $pdf = PDF::loadView('panel.reporteVenta.pdf.cuerpo', compact('ventas'));

        $pdf->setOptions([
            'margin-top' => 30,
            'header-html' => view('reportePdfSection.cabecera'),
            'footer-center' => '[page]/[toPage]',
            'orientation' => 'Landscape'
        ]);

        return $pdf->download("reporte_ventas_generado_" . now()->format('d/m/Y') . '.pdf');
    }

    public function generarExcelVentas(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json("Contenido no disponible", 404);
        }
        return Excel::download(new VentasExport($request->all()), "reporte_ventas_generado.xlsx");
    }


}
