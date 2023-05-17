<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\PagoCliente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        return view('panel.pago.index');
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $registros = PagoCliente::query()
            ->where('estado',1)
            ->paginate();


        return view('panel.pago.listado')->with(compact('registros'))->render();
    }

    public function resources(Request $request)
    {
        return ;
    }

    public function create(Request $request, $idmatricula = null)
    {
        $matricula = Matricula::query()->where('idmatricula',$idmatricula)->where('estado',1)->first();


        return view('panel.pago.create')->with(compact('matricula', 'idmatricula'));
    }

    public function store(Request $request)
    {
        return ;
    }

    public function edit(Request $request)
    {
        return ;
    }

    public function update(Request $request)
    {
        return ;
    }

    public function destroy(Request $request)
    {
        return ;
    }

}
