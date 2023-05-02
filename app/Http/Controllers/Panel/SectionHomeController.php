<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Section;
use App\Models\SectionHome;
use App\Models\SectionHomeLink;
use App\Models\SectionHomeProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SectionHomeController extends Controller
{

    public function index()
    {
        $productsDestacados = Producto::query()
            ->where('destacado', true)
            ->orderBy('idproducto', 'desc')
            ->take(20)
            ->get();

        $numberImages = 5;

        $marcas = Marca::query()
            ->where('estado', true)
            ->orderBy('idmarca', 'desc')
            ->get();

        $categorias = Categoria::query()
            ->where('estado', true)
            ->orderBy('idcategoria', 'desc')
            ->get();

        $sections = Section::query()
            ->where('estado', true)
            ->orderBy('idsection', 'desc')
            ->get();


        return view('panel.sectionHome.index')->with(compact('productsDestacados', 'numberImages', 'marcas', 'categorias', 'sections'));


    }

    public function getSections()
    {

        $registros = SectionHome::query()
            ->with(['links', 'products'])
            ->orderBy('posicion')
            ->orderBy('idsection_home')
            ->get();

        return response()->json($registros);

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }




        try {
            $seccion               = new SectionHome();
            $seccion->tipo         = $request->input('tipo');
            $seccion->titulo       = $request->input('titulo');
            $seccion->slug         = Str::slug($request->input('titulo'));
            $seccion->subtitulo    = $request->input('subtitulo');
            $seccion->contenido    = $request->input('contenidoHtml');
            $seccion->nuevo           = $request->input('nuevo');
            $seccion->destacado       = $request->input('destacado');
            $seccion->liquidacion     = $request->input('liquidacion');
            $seccion->idmarca         = $request->input('idmarca');
            $seccion->idcategoria     = $request->input('idcategoria');
            $seccion->idsection       = $request->input('idsection');
            $seccion->cantidad_slider = $request->input('cantidad_slider');

            $seccion->posicion     = $request->input('posicion');
            $seccion->estado    = $request->input('estado',1);
            $seccion->save();

            if (count($request->input('link',[])) > 0){
                for ($i=0; $i < count($request->input('link')); $i++) {
                    $link = new SectionHomeLink();

                    $link->idsection_home = $seccion->idsection_home;
                    $link->texto      = $request->input('textoBoton.'.$i);
                    $link->link       = $request->input('link.'.$i);
                    $link->contenido  = $request->input('contenido.'.$i);
                    if ($request->hasFile('imagen.'.$i)){
                        $nameFile = Storage::disk('panel')->putFile('sectionHome',$request->file('imagen.'.$i));
                        $link->imagen = basename($nameFile);
                    }
                    $link->posicion = $i+1;
                    $link->save();


                }
            }



            if (count($request->input('productos',[])) > 0){
                for ($i=0; $i < count($request->input('productos')); $i++) {
                    $producto = new SectionHomeProducto();
                    $producto->idsection_home = $seccion->idsection_home;
                    $producto->idproducto = $request->input('productos.'.$i);
                    $producto->posicion = $i+1;
                    $producto->save();
                }
            }

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

    public function update(Request $request,$idsection_home)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection_home = $request->input('idsection_home');
        try {
            $seccion = SectionHome::query()->findOrFail($idsection_home);
            $seccion->tipo         = $request->input('tipo');
            $seccion->titulo       = $request->input('titulo');
            $seccion->slug         = Str::slug($request->input('titulo'));
            $seccion->subtitulo    = $request->input('subtitulo');
            $seccion->contenido    = $request->input('contenidoHtml');
            $seccion->nuevo           = $request->input('nuevo');
            $seccion->destacado       = $request->input('destacado');
            $seccion->liquidacion     = $request->input('liquidacion');
            $seccion->idmarca         = $request->input('idmarca');
            $seccion->idcategoria     = $request->input('idcategoria');
            $seccion->idsection       = $request->input('idsection');
            $seccion->cantidad_slider = $request->input('cantidad_slider');
            $seccion->posicion     = $request->input('posicion');
            $seccion->estado    = $request->input('estado',1);
            $seccion->update();


            if (count($request->input('link',[])) > 0){



                for ($i=0; $i < count($request->input('link')); $i++) {

                    $idsection_home_link = $request->input('idsection_home_link.'.$i);

                    $link = SectionHomeLink::query()->find($idsection_home_link);

                    if (empty($link)) {
                        $link = new SectionHomeLink();
                        $link->idsection_home = $seccion->idsection_home;
                    }

                    $link->texto      = $request->input('textoBoton.'.$i);
                    $link->link       = $request->input('link.'.$i);
                    $link->contenido  = $request->input('contenido.'.$i);
                    if ($request->hasFile('imagen.'.$i)){
                        $nameFile = Storage::disk('panel')->putFile('sectionHome',$request->file('imagen.'.$i));
                        $link->imagen = basename($nameFile);
                    }
                    $link->posicion = $i+1;
                    $link->save();


                }
            }



            if (count($request->input('productos',[])) > 0){

                SectionHomeProducto::query()->where('idsection_home',$idsection_home)->delete();

                for ($i=0; $i < count($request->input('productos')); $i++) {
                    $producto = new SectionHomeProducto();
                    $producto->idsection_home = $seccion->idsection_home;
                    $producto->idproducto = $request->input('productos.'.$i);
                    $producto->posicion = $i+1;
                    $producto->save();
                }
            }


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

    public function destroy(Request $request,$idsection_home)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection_home = $request->input('idsection_home');

        try {

            SectionHome::query()->findOrFail($idsection_home)->delete();
            SectionHomeLink::query()->where('idsection_home',$idsection_home)->delete();
            SectionHomeProducto::query()->where('idsection_home',$idsection_home)->delete();

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




}
