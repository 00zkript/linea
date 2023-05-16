<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActividadSemanal;
use App\Models\CantidadSesiones;
use App\Models\Concepto;
use App\Models\Departamento;
use App\Models\Dia;
use App\Models\Distrito;
use App\Models\Horario;
use App\Models\Matricula;
use App\Models\Piscina;
use App\Models\Provincia;
use App\Models\Sucursal;
use App\Models\Temporada;
use App\Models\TipoDocumentoIdentidad;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('panel.matricula.index');
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $text = $request->input('text');

        $registros = Matricula::query()
            ->when($text, function ($query) {
                // return $query->where('cliente')
            })
            ->where('estado',1)
            ->paginate();

        return view('panel.matricula.listado')->with(compact('registros'))->render();
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
        $cantidadesDeSesiones = CantidadSesiones::query()->where('estado',1)->get();
        $horarios = Horario::query()->where('estado',1)->get();
        $dias = Dia::query()->where('estado',1)->get();

        return response()->json(compact('tipoDocumentoIdentidad', 'departamentos', 'conceptos', 'empleado', 'sucursales', 'temporadas', 'piscionas', 'actividadSemanal', 'cantidadesDeSesiones', 'horarios', 'dias'));
    }

    public function create()
    {
        return view('panel.matricula.create');
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
