<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\UsuarioTrait as Permissivel;

class Funcionario extends Authenticatable {
    use Notifiable;
    use Permissivel;

    protected $fillable = ['nome', 'prontuario', 'sexo', 'cpf', 'data_nascimento', 'endereco', 'foto', 'email', 'password', 'cargo_id'];
    protected $hidden = [ 'password', 'remember_token' ];
	public $timestamps = false;
	
    public function cargos(){
        return $this->belongsToMany(Cargo::class, 'cargos_funcionarios');
    }

    public function getSexoAttribute(){ 
        $sexo = strtolower($this->attributes['sexo']);
        if($sexo == 'f') {
            $sexo = 'Feminino';
        } else if ($sexo == 'm') {
            $sexo = 'Masculino';
        } else {
            $sexo = 'Indefinido';
        }

        return $sexo;
    }

    public function setCpfAttribute($value){
        $this->attributes['cpf'] = limpaPontuacao($value);
    }

    public function getCpfAttribute(){
        return formataCPF($this->attributes['cpf']);
    }

    public function setRememberToken($value){} // FIXIT: Só para não dar erro de falta de remember_token
}
