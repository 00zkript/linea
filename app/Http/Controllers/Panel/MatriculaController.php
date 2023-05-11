<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('panel.matricula.index');
    }
}
