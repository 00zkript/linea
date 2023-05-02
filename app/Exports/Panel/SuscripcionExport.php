<?php

namespace App\Exports\Panel;

use App\Models\Suscripcion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class SuscripcionExport implements FromView,ShouldAutoSize,WithColumnFormatting
{

    public function __construct()
    {
    }


    public function view(): View
    {

        $suscripciones = Suscripcion::query()->get();

        return view('panel.suscripcion.excel.cuerpo')->with(compact('suscripciones'));
    }


    public function columnFormats(): array
    {
        return [
            // 'G' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            // 'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            // 'I' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
        ];
    }

}
