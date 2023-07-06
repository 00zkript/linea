<?php

namespace App\Http\Controllers\Panel;

use App\Models\Dia;
use App\Models\Horario;
use App\Models\Nivel;
use App\Models\Concepto;
use App\Models\Distrito;
use App\Models\Sucursal;
use App\Models\Matricula;
use App\Models\Provincia;
use App\Models\Temporada;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Frecuencia;
use App\Models\CantidadClases;
use App\Http\Controllers\Controller;
use App\Models\Carril;
use App\Models\CarrilHasFrecuencia;
use App\Models\Cliente;
use App\Models\MatriculaDetalle;
use App\Models\Programa;
use App\Models\TipoDocumentoIdentidad;
use Illuminate\Support\Facades\Storage;

class MatriculaController extends Controller
{
    public function index()
    {
        $registros = Matricula::query()
            ->with(['temporada','programa'])
            ->orderBy('idmatricula','DESC')
            ->withSucursal()
            ->paginate(10,['*'],'pagina',1);

        return view('panel.matricula.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Matricula::query()
            ->with(['temporada','programa'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('idmatricula','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('cliente_nombres','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('cliente_apellidos','LIKE','%'.$txtBuscar.'%');
            })
            ->withSucursal()
            ->orderBy('idmatricula','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);

        return view('panel.matricula.listado')->with(compact('registros'))->render();
    }

    public function create($clienteID = 0)
    {
        return view('panel.matricula.crear')->with(compact('clienteID'));
    }

    public function edit($matriculaID)
    {
        return view('panel.matricula.editar')->with(compact('matriculaID'));
    }

    public function show( Request $request, $matriculaID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $matricula = Matricula::query()
            ->with([
                'detalle',
                'clienteTipoDocumentoIdentidad',
                'empleadoTipoDocumentoIdentidad',
                'sucursal',
                'concepto',
                'temporada',
                'programa',
                'nivel',
                'carril',
                'frecuencia',
            ])
            ->find($matriculaID);

        if(!$matricula){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($matricula);
    }

    public function habilitar(Request $request,$idmatricula)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Matricula::query()->findOrFail($idmatricula);
            $registro->estado    = 1;
            $registro->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function inhabilitar(Request $request,$idmatricula)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Matricula::query()->findOrFail($idmatricula);
            $registro->estado    = 0;
            $registro->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }






    public function resources(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();
        $departamentos = Departamento::query()->where('estado',1)->get();

        $empleado = auth()->user()->only(['idusuario','nombres','apellidos']);
        $sucursal = auth()->user()->sucursal;

        $conceptos = Concepto::query()->where('estado',1)->get();
        $cantidadClases = CantidadClases::query()->where('estado',1)->get();

        $temporadas = Temporada::query()
            ->where('estado',1)
            ->orderBy('idtemporada','desc')
            ->get();

        $temporada = Temporada::query()
            ->whereDate("fecha_desde", "<", now()->format('Y-m-d'))
            ->whereDate("fecha_hasta", ">=", now()->format('Y-m-d'))
            ->where('estado',1)
            ->orderBy('idtemporada','desc')
            ->first();

        $programas = Programa::query()->where('estado',1)->get();
        $horarios = Horario::query()->where('estado',1)->get();


        return response()->json([
            "resources" => [
                'tipoDocumentoIdentidad' => $tipoDocumentoIdentidad,
                'departamentos' => $departamentos,
                'conceptos' => $conceptos,
                'temporadas' => $temporadas,
                'programas' => $programas,
                'horarios' => $horarios,
                'cantidadClases' => $cantidadClases,
            ],
            "current" => [
                'empleado' => $empleado,
                'sucursal' => $sucursal,
                "temporada" => $temporada,
            ]
        ]);
    }

    public function alumno(Request $request, $clienteID)
    {
        $alumno = Cliente::query()
            ->where('idcliente',$clienteID)
            ->where('idsucursal', auth()->user()->sucursal->idsucursal)
            ->where('estado',1)
            ->first();

        return response()->json($alumno);
    }

    public function matricula(Request $request, $matriculaID)
    {

        $matricula = Matricula::query()->with(['detalle'])->find($matriculaID);

        $alumno = Cliente::query()
            ->where('idcliente',$matricula->idcliente)
            ->where('idsucursal', auth()->user()->sucursal->idsucursal)
            ->where('estado',1)
            ->first();

        $programas = Programa::query()->where('idtemporada',$matricula->idtemporada)->where('estado',1)->get();
        $niveles = Nivel::query()->where('idprograma',$matricula->idprograma)->where('estado',1)->get();
        $carriles = Carril::query()->where('idnivel',$matricula->idnivel)->where('estado',1)->get();
        $frecuencias = $matricula->programa->frecuencias()->where('estado',1)->get();

        return response()->json([
            "resources" => [
                "programas" => $programas,
                "niveles" => $niveles,
                "carriles" => $carriles,
                "frecuencias" => $frecuencias,
            ],
            "matricula" => $matricula,
            "alumno" => $alumno,
        ]);
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


    public function niveles(Request $request,$programaID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $niveles = Nivel::query()->where('idprograma',$programaID)->where('estado',1)->get();

        return response()->json($niveles);
    }

    public function carriles(Request $request,$nivelID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $carriles = Carril::query()->where('idnivel',$nivelID)->where('estado',1)->get();

        return response()->json($carriles);
    }

    public function frecuencias(Request $request,$programaID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $programa = Programa::query()->find($programaID);
        $frecuencias = $programa->frecuencias()->where('estado',1)->get();

        return response()->json($frecuencias);
    }

    public function cantidadDeAlumnosMatriculados(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $temporadaID = $request->input('idtemporada');
        $programaID = $request->input('idprograma');
        $piscinaID = $request->input('idnivel');
        $carrilID = $request->input('idcarril');
        $frecuenciaID = $request->input('idfrecuencia');

        $carril = Carril::query()->where('idcarril',$carrilID)->first();

        $cantidadMatriculados = Matricula::query()
            ->where('idtemporada', $temporadaID)
            ->where('idprograma', $programaID)
            ->where('idnivel', $piscinaID)
            ->where('idcarril', $carrilID)
            ->where('idfrecuencia', $frecuenciaID)
            ->whereNotNull('finalizado_at')
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
        $idnivel           = $request->input('idnivel');
        $idcarril            = $request->input('idcarril');
        $idfrecuencia = $request->input('idfrecuencia');
        $idcantidad_clases = $request->input('idcantidad_clases');
        $idcliente           = $request->input('idcliente');
        $detalle             = $request->input('detalle');



        $fecha_inicio     = now()->parse($fecha[0])->format('Y-m-d');
        $fecha_fin        = now()->parse($fecha[1])->format('Y-m-d');
        $cliente          = Cliente::query()->find($idcliente);
        $empleado         = auth()->user();
        $cantidadClases   = CantidadClases::query()->find($idcantidad_clases);


        $matricula = new Matricula();
        $matricula->idsucursal                          = $idsucursal;
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
        $matricula->idprograma                          = $idprograma;
        $matricula->idnivel                             = $idnivel;
        $matricula->idcarril                            = $idcarril;
        $matricula->idfrecuencia                        = $idfrecuencia;
        $matricula->idcantidad_clases                   = $idcantidad_clases;
        $matricula->cantidad_clases                     = $cantidadClases->cantidad;
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


    public function updateMatricula(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $matriculaID         = $request->input('idmatricula');
        $fecha               = $request->input('fecha');
        $idconcepto          = $request->input('idconcepto');
        $idempleado          = $request->input('idempleado');
        $idsucursal          = $request->input('idsucursal');
        $idtemporada         = $request->input('idtemporada');
        $idprograma          = $request->input('idprograma');
        $idnivel             = $request->input('idnivel');
        $idcarril            = $request->input('idcarril');
        $idfrecuencia        = $request->input('idfrecuencia');
        $idcantidad_clases   = $request->input('idcantidad_clases');
        $idcliente           = $request->input('idcliente');
        $detalle             = $request->input('detalle');



        $fecha_inicio     = now()->parse($fecha[0])->format('Y-m-d');
        $fecha_fin        = now()->parse($fecha[1])->format('Y-m-d');
        $cliente          = Cliente::query()->find($idcliente);
        $empleado         = auth()->user();
        $cantidadClases   = CantidadClases::query()->find($idcantidad_clases);


        $matricula = Matricula::query()->find($matriculaID);
        $matricula->idsucursal                          = $idsucursal;
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
        $matricula->idprograma                          = $idprograma;
        $matricula->idnivel                             = $idnivel;
        $matricula->idcarril                            = $idcarril;
        $matricula->idfrecuencia                        = $idfrecuencia;
        $matricula->idcantidad_clases                   = $idcantidad_clases;
        $matricula->cantidad_clases                     = $cantidadClases->cantidad;
        $matricula->monto_total                         = $cantidadClases->precio;
        $matricula->estado                              = 1;
        $matricula->update();

        MatriculaDetalle::query()->where('idmatricula',$matricula->idmatricula)->delete();
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
