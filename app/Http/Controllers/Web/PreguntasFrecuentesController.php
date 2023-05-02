<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PreguntasFrecuentes;
use Illuminate\Http\Request;

class PreguntasFrecuentesController extends Controller
{

    public function index()
    {

        $preguntas = PreguntasFrecuentes::query()
            ->where('estado',1)
            ->get();

        Return view('web.preguntasFrecuentes.index')->with(compact('preguntas'));
    }


}
