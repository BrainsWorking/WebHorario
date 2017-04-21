<?php
namespace Requests\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Arr;

class CustomValidator extends Validator {

    public function timeBefore($field, $value, $parameters){
        $this->requireParameterCount(1, $parameters, 'TimeBefore');
        $other = Arr::get($this->data, $parameters[0]);

        $value = strtotime($value);
        $other = strtotime($other);
        
        return $value < $other;
    }

    public function timeAfter($field, $value, $parameters){
        $this->requireParameterCount(1, $parameters, 'TimeAfter');
        $other = Arr::get($this->data, $parameters[0]);

        $value = strtotime($value);
        $other = strtotime($other);
        
        return $value > $other;
    }

    public function sex($field, $value){
        $genres = ['f', 'm', 'i'];
        $value = strtolower($value);

        return in_array($value, $genres);
    }

    public function rg($field, $value){
        return preg_match('/^\d{2}\.\d{3}\.\d{3}-\d{1}$/', $value);
    }

    public function cpf($field, $value){
        // TODO: Fazer uma validação de CPF mesmo
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value);
    }
}