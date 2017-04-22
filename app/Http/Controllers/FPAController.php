<?php

namespace App\Http\Controllers;

use App\Models\FPA;
use Illuminate\Http\Request;

class FPAController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function salvar(Request $request){
        Fpa::firstOrCreate($request->all());
    }

    public function cadastrar(){
        return view('Fpa.formFpa');
    }

    public function deletar($id){
        Fpa::findOrFail($id) -> delete();
    }

}
