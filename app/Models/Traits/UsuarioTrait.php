<?php 
namespace App\Models\Auth;

trait UsuarioTrait{
    public function pode($acao){
        $perfil = $this->cargo->nome;
        return in_array($acao, Permissoes::$perfil());
    }

    public function naoPode($acao){
        return !$this->pode($acao);
    }

    public function __call($metodo, $parametros) {
        if(substr($metodo, 0, 4) == 'pode') {
            $acao = strtolower(substr($metodo, 4));
            return call_user_func([$this, 'pode'], $acao);
        } else if(substr($metodo, 0, 7) == 'naopode') {
            $acao = strtolower(substr($metodo, 7));
            return call_user_func([$this, 'naoPode'], $acao);
        } else {
            return parent::__call($metodo, $parametros);
        }
    }
}