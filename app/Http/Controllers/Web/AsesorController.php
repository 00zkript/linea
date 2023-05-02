<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index(Request $request)
    {
        $urlProducto = $request->input('url_producto');

        $asesores = DB::table('asesor')
            ->orderBy('idasesor', 'DESC')
            ->where('estado', 1)
            ->get();



        return view('web.asesores.index')->with(compact('asesores', 'urlProducto'));
    }
}
