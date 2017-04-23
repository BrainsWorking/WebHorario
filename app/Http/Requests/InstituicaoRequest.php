<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'     => 'required', 
            'cep'      => 'required', 
            'endereco' => 'required', 
            'telefone' => 'required'
        ];
    }
}
