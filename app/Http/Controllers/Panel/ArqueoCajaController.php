<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArqueoCajaController extends Controller
{

    public function historialCambio()
    {

        return view('panel.arqueoCaja.historialCambio');
    }

    public function historialCambioListado()
    {

        return view('panel.arqueoCaja.historialCambioListado')->render();
    }

}
