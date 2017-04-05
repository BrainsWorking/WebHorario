<?php 
namespace App\Models\Auth;

trait UsuarioTrait{
    public function pode($acao){
        $perfil = $this->perfil->nome;
        return in_array($acao, Restricoes::$perfil());
    }

    public function __call($method, $parameters) {
        if(strtolower(substr($method, 0, 4)) == 'pode'){
            $action = strtolower(substr($method, 4));
            return call_user_func([$this, 'pode'], $action);
        } else {
            return parent::__call($method, $parameters);
        }
    }
}