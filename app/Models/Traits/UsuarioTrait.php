<?php 
namespace App\Models\Traits;

trait UsuarioTrait{
    public function pode($acao){
        $permissoes = new Permissoes;

        foreach($this->cargos as $cargo){
            $cargo = formatarDash($cargo->nome);

            if(method_exists($permissoes, $cargo) 
            && in_array($acao, $permissoes->$cargo())) {
                return true;
            }
        }

        if($this->isCoordenador()){
            if(in_array($acao, $permissoes->coordenador())) {
                return true;
            }
        }

        return false;
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