<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginaController extends Controller
{
    public function index()
    {

        $paginas = Pagina::query()
            ->where('estado',1)
            ->orderBy('fecha',"desc")->get();

        return view('web.pagina.index')->with(compact('paginas'));
    }


    public function detalle($slug)
    {
        $pagina = Pagina::query()->where('slug',$slug)->first();

        if (!$pagina) {
            return abort(404);
        }

        return view('web.pagina.detalle')->with(compact('pagina'));

    }

    public function politicaPrivacidad()
    {

        $pagina = DB::table('politica_privacidad')->first();

        return view('web.pagina.politicaPrivacidad')->with(compact('pagina'));
    }


    public function terminosCondiciones()
    {

        $terminosCondiciones = DB::table('terminos_condiciones')
            ->first();

        return view('web.pagina.terminosCondiciones')->with(compact('terminosCondiciones'));
    }





}
