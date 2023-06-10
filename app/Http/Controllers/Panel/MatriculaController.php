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
use App\Models\Carril;
use App\Models\Cliente;
use App\Models\MatriculaDetalle;
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
            ->where('estado',1)
            ->get();

        $cantidadClases = CantidadClases::query()->where('estado',1)->get();
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
                'cantidadClases' => $cantidadClases,
                'horarios' => $horarios,
            ],
            "current" => [
                'empleado' => $empleado,
                'sucursal' => $sucursalCurrent,
                "temporada" => $temporadaCurrent,
            ]
        ]);
    }

    public function create($clienteID = null)
    {
        $alumno = Cliente::query()
            ->with([
                'tipoDocumentoIdentidad',
                'departamento',
                'provincia',
                'distrito',
            ])
            ->where('idcliente',$clienteID)
            ->where('idsucursal', auth()->user()->sucursal->idsucursal)
            ->where('estado',1)
            ->first();

        return view('panel.matricula.create')->with(compact('alumno'));
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

    public function cantidadDeAlumnosMatriculados(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $temporadaID = $request->input('idtemporada');
        $programaID = $request->input('idprograma');
        $piscinaID = $request->input('idpiscina');
        $carrilID = $request->input('idcarril');

        $carril = Carril::query()->where('idcarril',$carrilID)->first();

        $cantidadMatriculados = Matricula::query()
            ->where('idtemporada', $temporadaID)
            ->where('idprograma', $programaID)
            ->where('idpiscina', $piscinaID)
            ->where('idcarril', $carrilID)
            ->count('idcliente');

        return response()->json([
            'cantidad_matriculados' => $cantidadMatriculados,
            'capacidad_maxima' => $carril->capacidad_maxima ?? 0
        ]);
    }

    public function storeMatricula(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $fecha               = $request->input('fecha');
        $idconcepto          = $request->input('idconcepto');
        $idempleado          = $request->input('idempleado');
        $idsucursal          = $request->input('idsucursal');
        $idtemporada         = $request->input('idtemporada');
        $idprograma          = $request->input('idprograma');
        $idpiscina           = $request->input('idpiscina');
        $idcarril            = $request->input('idcarril');
        $idactividad_semanal = $request->input('idactividad_semanal');
        $idcantidad_clases = $request->input('idcantidad_clases');
        $idcliente           = $request->input('idcliente');
        $detalle             = $request->input('detalle');



        $fecha_inicio     = now()->parse($fecha[0])->format('Y-m-d');
        $fecha_fin        = now()->parse($fecha[1])->format('Y-m-d');
        $cliente          = Cliente::query()->find($idcliente);
        $empleado         = auth()->user();
        $sucursal         = auth()->user()->sucursal;
        $temporada        = Temporada::query()->find($idtemporada);
        $programa         = Programa::query()->find($idprograma);
        $cantidadClases   = CantidadClases::query()->find($idcantidad_clases);
        $actividadSemanal = ActividadSemanal::query()->find($idactividad_semanal);


        $matricula = new Matricula();
        $matricula->idsucursal                          = $idsucursal;
        $matricula->sucursal_nombre                     = $sucursal->nombre;
        $matricula->sucursal_direccion                  = $sucursal->direccion;
        $matricula->idcliente                           = $idcliente;
        $matricula->cliente_nombres                     = $cliente->nombres;
        $matricula->cliente_apellidos                   = $cliente->apellidos;
        $matricula->cliente_idtipo_documento_identidad  = $cliente->idtipo_documento_identidad;
        $matricula->cliente_numero_documento_identidad  = $cliente->numero_documento_identidad;
        $matricula->idempleado                          = $idempleado;
        $matricula->empleado_nombres                    = $empleado->nombres;
        $matricula->empleado_apellidos                  = $empleado->apellidos;
        $matricula->empleado_idtipo_documento_identidad = $empleado->idtipo_documento_identidad;
        $matricula->empleado_numero_documento_identidad = $empleado->numero_documento_identidad;
        $matricula->fecha_inicio                        = $fecha_inicio;
        $matricula->fecha_fin                           = $fecha_fin;
        $matricula->idconcepto                          = $idconcepto;
        $matricula->idtemporada                         = $idtemporada;
        $matricula->temporada_nombre                    = $temporada->nombre;
        $matricula->idprograma                          = $idprograma;
        $matricula->programa_nombre                     = $programa->nombre;
        $matricula->idcantidad_clases                   = $idcantidad_clases;
        $matricula->cantidad_clases_nombre              = $cantidadClases->nombre;
        $matricula->cantidad_clases_cantidad            = $cantidadClases->cantidad;
        $matricula->idactividad_semanal                 = $idactividad_semanal;
        $matricula->actividad_semanal_nombre            = $actividadSemanal->nombre;
        $matricula->idpiscina                           = $idpiscina;
        $matricula->idcarril                            = $idcarril;
        $matricula->monto_total                         = $cantidadClases->precio;
        $matricula->estado                              = 1;
        $matricula->save();

        foreach ($detalle as $item) {
            $horario = new MatriculaDetalle();
            $horario->idmatricula = $matricula->idmatricula;
            $horario->fecha = $item['fecha'];
            $horario->idhorario = $item['idhorario'];
            $horario->dia_nombre = $item['dia_name'];
            $horario->horario_nombre = $item['horario_nombre'];
            $horario->save();
        }


        return response()->json([
            'codigo' => str_pad($matricula->idmatricula,7,0,STR_PAD_LEFT)
        ]);

    }








}
