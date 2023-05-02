<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PopupRequest;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $popups = DB::table('popup AS p')
            ->selectRaw('p.*')
            ->orderBy('p.orden', 'ASC')
            ->orderBy('p.pagina')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.popup.index')->with(compact('popups'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $popups = DB::table('popup AS p')
            ->selectRaw('p.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('p.pagina LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('p.orden', 'ASC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.popup.listado')->with(compact('popups'))->render());


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
     * @return Response
     */
    public function store(PopupRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $popup = new Popup();
            $popup->pagina = $request->input('pagina');

            if ($request->hasFile('imagen')) {
                $imagen = Storage::disk('panel')->putFile('popup', $request->file('imagen'));
                $popup->imagen = basename($imagen);
            }

            $popup->enlace = $request->input('enlace');
            $popup->orden = $request->input('orden');
            $popup->estado = $request->input('estado');
            $popup->save();


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

        $popup = Popup::query()->find($request->input('idpopup'));


        if(!$popup){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($popup);


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

        $popup = Popup::query()->find($request->input('idpopup'));

        if(!$popup){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($popup);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(popupRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }



        try{

            $popup = Popup::query()->findOrFail($request->input('idpopup'));
            $popup->pagina = $request->input('paginaEditar');

            if ($request->hasFile('imagenEditar')) {

                if (Storage::disk('panel')->exists('popup/' . $popup->imagen)) {
                    Storage::disk('panel')->delete('popup/' . $popup->imagen);
                }


                $imagen = Storage::disk('panel')->putFile('popup', $request->file('imagenEditar'));
                $popup->imagen = basename($imagen);
            }

            $popup->enlace = $request->input('enlaceEditar');
            $popup->orden = $request->input('ordenEditar');
            $popup->estado = $request->input('estadoEditar');
            $popup->update();


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
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Popup::query()->findOrFail($request->input('idpopup'));
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

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Popup::query()->findOrFail($request->input('idpopup'));
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

    public function destroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $popup = Popup::query()->findOrFail($request->input('idpopup'));

            if (Storage::disk('panel')->exists('popup/' . $popup->imagen)) {
                Storage::disk('panel')->delete('popup/' . $popup->imagen);
            }

            $popup->delete();

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
            $popup = Popup::query()->find($request->input('idpopup'));
            Storage::disk('panel')->delete('popup/' . $popup->imagen);
            $popup->imagen = null;
            $popup->update();

            return response()->json([
                'mensaje'=> "Archivo eliminado exitosamente.",
            ]);

        }catch (\Throwable $th){

            return response()->json([
                'mensaje'=> "No se pudo eliminar el archivo.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }


    public function cantidadPopups(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $pagina = $request->input('pagina');

        $cantidad = DB::table('popup')
            ->where('pagina', $pagina)
            ->count();

        return response()->json($cantidad + 1);

    }
}
