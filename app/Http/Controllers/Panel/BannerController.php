<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\BannerRequest;
use App\Models\Banner;
use App\Models\BannerTipo;
use App\Models\Categoria;
use App\Models\Menu;
use App\Models\Pagina;
use App\Models\TipoRuta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $rutaInterna = Menu::getRoutesInternal();

        $categorias = Categoria::query()
            ->orderBy('nivel','ASC')
            ->orderBy('orden','ASC')
            ->get()
            ->map(function ($c){
                return (object)[
                    "key" => $c->slug_categoria,
                    "nombre" => route('web.productos.categoria',$c->slug_categoria)
                ];
            });

        $paginas = Pagina::query()
            ->where('estado',1)
            ->get()
            ->map(function ($p){
                return (object)[
                    "key" => $p->slug,
                    "nombre" => route('web.pagina.detalle',$p->slug)
                ];
            });

        $tipos = BannerTipo::query()->where('estado',1)->get();;

        $tiposRuta = TipoRuta::query()->where('is_internal',1)->where('estado',1)->get();

        $banners = Banner::query()
            ->orderBy('ruta')
            ->orderBy('posicion', 'ASC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.banner.index')->with(compact('banners','rutaInterna','categorias','paginas','tiposRuta', 'tipos'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $banners = Banner::query()
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('titulo', 'like', "%$txtBuscar%" )
                    ->orWhere('subtitulo', 'like', "%$txtBuscar%")
                    ->orWhere('ruta', 'like', "%$txtBuscar%");
            })
            ->orderBy('posicion', 'ASC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.banner.listado')->with(compact('banners'))->render());


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BannerRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $TIPO_IMAGEN_ID = 1;
        $TIPO_VIDEO_ID = 2;


        try {

            $banner = new Banner;
            $banner->nombre         = $request->input('nombre');
            $banner->idtipo_ruta    = $request->input('tipoRuta');
            $banner->ruta           = $request->input('ruta');
            $banner->posicion       = $request->input('posicion');
            $banner->idbanner_tipo  = $request->input('idbannerTipo');

            if ( $banner->idbanner_tipo == $TIPO_IMAGEN_ID ) {
                $banner->contenido      = $request->input('contenido');
                $banner->boton_text     = $request->input('botonText');
                $banner->boton_target   = $request->input('botonTarget');
                $banner->boton_link     = $request->input('botonLink');

                if ($request->hasFile('imagen')) {
                    // $imagen = Storage::disk('panel')->putFile('banner', $request->file('imagen'));
                    $imagen = $request->file('imagen')->store('banner','panel');
                    $banner->imagen = basename($imagen);
                }

                if ($request->hasFile('imagenMovil')) {
                    $imagen = $request->file('imagenMovil')->store('banner','panel');
                    $banner->imagen_movil = basename($imagen);
                }
            }
            if ( $banner->idbanner_tipo == $TIPO_VIDEO_ID ) {
                if ($request->hasFile('video')) {
                    // $file = Storage::disk('panel')->putFile('banner', $request->file('video'));
                    $file = $request->file('video')->store('banner','panel');
                    $banner->video = basename($file);
                }
            }

            $banner->estado = $request->input('estado');
            $banner->save();

            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');
        $banner = Banner::query()->find($idbanner);

        if(!$banner){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idbanner = $request->input('idbanner');
        $banner = Banner::query()->with(['tipoRuta','tipo'])->find($idbanner);

        if(!$banner){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BannerRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }
        $TIPO_IMAGEN_ID = 1;
        $TIPO_VIDEO_ID = 2;


        try {

            $banner               = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->nombre         = $request->input('nombreEditar');
            $banner->idtipo_ruta    = $request->input('tipoRutaEditar');
            $banner->ruta           = $request->input('rutaEditar');
            $banner->posicion       = $request->input('posicionEditar');

            $banner->idbanner_tipo = $request->input('idbannerTipoEditar');

            if ( $banner->idbanner_tipo == $TIPO_IMAGEN_ID ) {
                $banner->contenido      = $request->input('contenidoEditar');
                $banner->boton_text     = $request->input('botonTextEditar');
                $banner->boton_target   = $request->input('botonTargetEditar');
                $banner->boton_link     = $request->input('botonLinkEditar');

                if ($request->hasFile('imagenEditar')) {
                    if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                        Storage::disk('panel')->delete('banner/' . $banner->imagen);
                    }
                    $imagen = $request->file('imagenEditar')->store('banner','panel');
                    $banner->imagen = basename($imagen);
                }

                if ($request->hasFile('imagenMovilEditar')) {
                    if (Storage::disk('panel')->exists('banner/' . $banner->imagen_movil)) {
                        Storage::disk('panel')->delete('banner/' . $banner->imagen_movil);
                    }
                    $imagen = $request->file('imagenMovilEditar')->store('banner','panel');
                    $banner->imagen_movil = basename($imagen);
                }

                if (Storage::disk('panel')->exists('banner/' . $banner->video)) {
                    Storage::disk('panel')->delete('banner/' . $banner->video);
                }


            }

            if ( $banner->idbanner_tipo == $TIPO_VIDEO_ID ) {

                $banner->contenido = null;
                $banner->boton_text = null;
                $banner->boton_target = null;
                $banner->boton_link = null;

                if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                    Storage::disk('panel')->delete('banner/' . $banner->imagen);
                }

                if (Storage::disk('panel')->exists('banner/' . $banner->imagen_movil)) {
                    Storage::disk('panel')->delete('banner/' . $banner->imagen_movil);
                }

                if ($request->hasFile('videoEditar')) {
                    if (Storage::disk('panel')->exists('banner/' . $banner->video)) {
                        Storage::disk('panel')->delete('banner/' . $banner->video);
                    }
                    $file = $request->file('videoEditar')->store('banner','panel');
                    $banner->video = basename($file);
                }

            }


            $banner->estado    = $request->input('estadoEditar');
            $banner->update();

            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }


    public function habilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $banner = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->estado = 1;
            $banner->update();



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

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $banner = Banner::query()->findOrFail($request->input('idbanner'));
            $banner->estado = 0;
            $banner->update();



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

        /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $banner = Banner::query()->findOrFail($request->input('idbanner'));

            if (Storage::disk('panel')->exists('banner/' . $banner->imagen)) {
                Storage::disk('panel')->delete('banner/' . $banner->imagen);
            }
            if (Storage::disk('panel')->exists('banner/' . $banner->imagen_movil)) {
                Storage::disk('panel')->delete('banner/' . $banner->imagen_movil);
            }
            if (Storage::disk('panel')->exists('banner/' . $banner->video)) {
                Storage::disk('panel')->delete('banner/' . $banner->video);
            }

            $banner->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }

    public function removerImagen(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }




        try {

            $banner = Banner::find($request->input('idbanner'));
            Storage::disk('panel')->delete('banner/' . $banner->imagen);
            $banner->imagen = null;
            $banner->update();

            return response()->json([
                "mensaje" => "Imagen eliminada con exito"
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar la imagen del registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }


    public function getPosicion(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $ruta = $request->input('ruta');

        $cantidad = Banner::query()
            ->where('ruta', $ruta)
            ->count();

        return response()->json([
            "posicion_maxima" => $cantidad + 1
        ]);

    }


}
