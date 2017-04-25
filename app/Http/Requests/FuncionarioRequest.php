<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'            => 'string|required',
            'prontuario'      => 'number|required',
            'rg'              => 'rg|required',
            'sexo'            => 'sex|required',
            'cpf'             => 'cpf|required',
            'data_nascimento' => 'date|required',
            'endereco'        => 'string|required',
            'foto'            => 'image|dimensions:max_width=250,max_height=250|required',
            'email'           => 'email|unique:Funcionarios,email|required',
            'password'        => 'required',
        ];
    }
}
