<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Curso;
use App\Models\Funcionario;

class CoordenadorController extends Controller
{
    private $totalPorPag = 10;

    public function index(){
        $cursos = Curso::orderBy('nome', 'asc')->paginate($this->totalPorPag);

        return view('coordenador.index', compact('cursos'));
    }
}
