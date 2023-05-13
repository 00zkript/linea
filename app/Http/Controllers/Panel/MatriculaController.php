<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActividadSemanal;
use App\Models\CantidadSesiones;
use App\Models\Concepto;
use App\Models\Departamento;
use App\Models\Dia;
use App\Models\Horario;
use App\Models\Piscina;
use App\Models\Sucursal;
use App\Models\Temporada;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('panel.matricula.index');
    }


    public function resources(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $departamentos = Departamento::query()->where('estado',1)->get();
        $conceptos = Concepto::query()->where('estado',1)->get();

        $empleado = [];
        $sucursales = Sucursal::query()->where('estado',1)->get();
        $temporadas = Temporada::query()->where('estado',1)->get();
        $piscionas = Piscina::query()->where('estado',1)->get();
        $actividadSemaal = ActividadSemanal::query()->where('estado',1)->get();
        $cantidadesDeSesiones = CantidadSesiones::query()->where('estado',1)->get();
        $horarios = Horario::query()->where('estado',1)->get();
        $dias = Dia::query()->where('estado',1)->get();

        return response()->json(compact('departamentos', 'conceptos', 'empleado', 'sucursales', 'temporadas', 'piscionas', 'actividadSemaal', 'cantidadesDeSesiones', 'horarios', 'dias'));
    }
}
