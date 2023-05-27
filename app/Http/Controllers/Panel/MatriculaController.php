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
use App\Models\CantidadSesiones;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Programa;
use App\Models\TipoDocumentoIdentidad;
use Illuminate\Support\Facades\Storage;

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
        $empleado = auth()->user()->only(['idusuario','nombres','apellidos']);

        $sucursales = Sucursal::query()->where('estado',1)->get();
        $sucursalCurrent = auth()->user()->sucursal;

        $temporadas = Temporada::query()
            ->with([
                'programas' => function ($query) {
                    return $query->where('estado',1);
                }
            ])
            ->whereDate("fecha_desde", "<", now()->format('Y-m-d'))
            ->whereDate("fecha_hasta", ">=", now()->format('Y-m-d'))
            ->where('estado',1)
            ->orderBy('idtemporada','desc')
            ->get();

        $temporadaCurrent = $temporadas[0];
        $programas = $temporadaCurrent->programas;

        $piscinas = Piscina::query()
            ->with([
                'carriles' => function ($query) {
                    return $query->where('estado',1);
                }
            ])
            ->where('estado',1)
            ->get();

        $actividadSemanal = ActividadSemanal::query()
            ->with([
                'dias' => function ($query) {
                    return $query->where('estado',1);
                }
            ])
            ->where('estado',1)
            ->get();

        $cantidadesDeSesiones = CantidadSesiones::query()->where('estado',1)->get();
        $horarios = Horario::query()->where('estado',1)->get();




        return response()->json([
            "resources" => [
                'tipoDocumentoIdentidad' => $tipoDocumentoIdentidad,
                'departamentos' => $departamentos,
                'conceptos' => $conceptos,
                'sucursales' => $sucursales,
                'temporadas' => $temporadas,
                'programas' => $programas,
                'piscinas' => $piscinas,
                'actividadSemanal' => $actividadSemanal,
                'cantidadesDeSesiones' => $cantidadesDeSesiones,
                'horarios' => $horarios,
            ],
            "current" => [
                'empleado' => $empleado,
                'sucursal' => $sucursalCurrent,
                "temporada" => $temporadaCurrent,
            ]
        ]);
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


    public function storeAlumno(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $idcliente                = $request->input('idcliente');
        $idsucursal               = auth()->user()->sucursal->idsucursal ?? null;
        $nombres                  = $request->input('nombres');
        $apellidos                = $request->input('apellidos');
        $correo                   = $request->input('correo');
        $telefono                 = $request->input('telefono');
        $apoderadoNombres   = $request->input('apoderado_nombres');
        $apoderadoApellidos = $request->input('apoderado_apellidos');
        $apoderadoCorreo    = $request->input('apoderado_correo');
        $apoderadoTelefono  = $request->input('apoderado_telefono');
        $tipoDocumentoIdentidad   = $request->input('idtipo_documento_identidad');
        $numeroDocumentoIdentidad = $request->input('numero_documento_identidad');
        $fechaNacimiento          = $request->input('fecha_nacimiento');
        $sexo                     = $request->input('sexo');
        $departamento             = $request->input('iddepartamento');
        $provincia                = $request->input('idprovincia');
        $distrito                 = $request->input('iddistrito');
        $direccion                = $request->input('direccion');
        $nota                     = $request->input('nota');
        $estado                   = 1;


        try {

            $cliente = Cliente::findOrNew($idcliente);

            $cliente->idsucursal                 = $idsucursal;
            $cliente->nombres                    = $nombres;
            $cliente->apellidos                  = $apellidos;
            $cliente->correo                     = $correo;
            $cliente->telefono                   = $telefono;
            $cliente->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $cliente->numero_documento_identidad = $numeroDocumentoIdentidad;
            $cliente->apoderado_nombres          = $apoderadoNombres;
            $cliente->apoderado_apellidos        = $apoderadoApellidos;
            $cliente->apoderado_correo           = $apoderadoCorreo;
            $cliente->apoderado_telefono         = $apoderadoTelefono;
            $cliente->fecha_nacimiento           = now()->parse($fechaNacimiento)->format('Y-m-d');
            $cliente->sexo                       = $sexo;
            $cliente->iddepartamento             = $departamento;
            $cliente->idprovincia                = $provincia;
            $cliente->iddistrito                 = $distrito;
            $cliente->direccion                  = $direccion;
            $cliente->nota                       = $nota;
            $cliente->estado                     = $estado;

            // if ( $request->hasFile('imagen') ) {
            //     $filename = Storage::disk('panel')->put('cliente', $request->file('imagen'));
            //     $cliente->imagen = $filename;
            // }

            $cliente->save();

            return response()->json([
                'mensaje'=> "Alumno creado exitosamente.",
                'idcliente' => $cliente->idcliente
            ]);


        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo crear el Alumno.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }

    }








}
