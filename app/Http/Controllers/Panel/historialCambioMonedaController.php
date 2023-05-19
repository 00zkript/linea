<?php

namespace App\Http\Controllers\PAnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class historialCambioMonedaController extends Controller
{
    public function index()
    {

        return view('panel.historialCambioMoneda.index');
    }

    public function listar()
    {

        return view('panel.historialCambioMoneda.listado')->render();
    }
}
