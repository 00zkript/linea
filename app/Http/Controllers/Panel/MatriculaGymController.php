<?php

namespace App\Http\Controllers\Panel;

use App\Models\Dia;
use App\Models\Horario;
use App\Models\Piscina;
use App\Models\Concepto;
use App\Models\Distrito;
use App\Models\Sucursal;
use App\Models\Matricula;
use App\Models\Provincia;
use App\Models\Temporada;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\ActividadSemanal;
use App\Models\CantidadClases;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumentoIdentidad;

class MatriculaGymController extends Controller
{
    public function index()
    {
        return view('panel.matriculaGym.index');
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $text = $request->input('text');

        $registros = Matricula::query()
            ->where('estado',1)
            ->paginate();

        return view('panel.matriculaGym.listado')->with(compact('registros'))->render();
    }


    public function resources(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();
        $departamentos = Departamento::query()->where('estado',1)->get();
        $conceptos = Concepto::query()->where('estado',1)->get();
        $empleado = [];
        $sucursales = Sucursal::query()->where('estado',1)->get();
        $temporadas = Temporada::query()->where('estado',1)->get();
        $piscionas = Piscina::query()->where('estado',1)->get();
        $actividadSemanal = ActividadSemanal::query()->where('estado',1)->get();
        $cantidadesClases = CantidadClases::query()->where('estado',1)->get();
        $horarios = Horario::query()->where('estado',1)->get();

        return response()->json(compact(
            'tipoDocumentoIdentidad',
            'departamentos',
            'conceptos',
            'empleado',
            'sucursales',
            'temporadas',
            'piscionas',
            'actividadSemanal',
            'cantidadesClases',
            'horarios'
        ));
    }

    public function create()
    {
        return view('panel.matriculaGym.create');
    }

    public function provincias(Request $request, $iddepartamento)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $provincias = Provincia::where('iddepartamento', $iddepartamento)->where('estado',1)->get();

        return response()->json($provincias);
    }

    public function distritos(Request $request, $idprovincia)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $distritos = Distrito::where('idprovincia', $idprovincia)->where('estado',1)->get();

        return response()->json($distritos);
    }





}
