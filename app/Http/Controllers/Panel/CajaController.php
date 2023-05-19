<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CajaController extends Controller
{

    public function historialCambio()
    {

        return view('panel.caja.historialCambio');
    }

    public function historialCambioListado()
    {

        return view('panel.caja.historialCambioListado')->render();
    }

}
