<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function cadastro(){
        $cursos = (object)[
            "nome" => "Matrmática"
        ];
        return view('turno.cadastro', compact('cursos'));
    }
}
