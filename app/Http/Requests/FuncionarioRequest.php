<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        if(in_array('atualizar',$this->segments())) {
            $email = 'email|required';
            $password = '';
        }else{
            $email = 'email|unique:funcionarios,email|required';
            $password = 'required';
        }

        if($this->has('foto')){
            $foto = "image|dimensions:max_width=250,max_height=250";
        } else { $foto = ''; } 

        return [
            'nome'            => 'string|required',
            'prontuario'      => 'numeric|required',
            'rg'              => 'rg|required',
            'sexo'            => 'sex|required',
            'cpf'             => 'cpf|required',
            'data_nascimento' => 'date|required',
            'endereco'        => 'string|required',
            'foto'            => $foto,
            'email'           => $email,
            'password'        => $password,
        ];
    }

    public function validationData(){
        $data = parent::all();

        $data['sexo'] = strtoupper($data['sexo']);
        $data['data_nascimento'] = converterDataIngles($data['data_nascimento']);

        if(!$this->has('password')){
            unset($data['password']);
        }
    
        return $data;
    }
}
