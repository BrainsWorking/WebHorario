<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'           => 'string|required', 
            'sigla'          => 'string|max:5|required', 
            'turno_id'       => 'exists:Turnos|required', 
            'funcionario_id' => 'exists:Funcionarios'
        ];
    }
}
