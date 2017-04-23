<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\UsuarioTrait as Permissivel;
use App\Models\Cargo;
use App\Models\Telefone;

class Funcionario extends Authenticatable {
    use Notifiable;
    use Permissivel;
    use SoftDeletes;
    
    protected $fillable = ['nome', 'prontuario', 'rg', 'sexo', 'cpf', 'data_nascimento', 'endereco', 'foto', 'email', 'password'];
    protected $hidden = [ 'password', 'remember_token' ];
    protected $dates = ['deleted_at'];
	public $timestamps = false;
	
    public function telefones(){
        return $this->hasMany(Telefone::class);
    }

    public function cargos(){
        return $this->belongsToMany(Cargo::class, 'cargos_funcionarios');
    }

    # Retorna o curso no qual é coordenador
    public function curso(){
        return $this->hasOne(Curso::class);
    }

    public function isCoordenador(){
        return !is_null($this->curso);
    }

    # Retorna uma string formatada listando os cargos
    public function getListaCargosAttribute() {
        $cargos = '';
        $allCargos = $this->cargos;

        if($this->isCoordenador()) {
            $allCargos['coordenador'] = new Cargo(['id' => 0, 'nome' => 'Coordenador de ' . $this->curso->sigla ]);
        }

        $nCargos = count($allCargos);
        $i = 1;
        foreach($allCargos as $cargo) {
            if($i == $nCargos && $nCargos > 1) {
                $cargos .= " e {$cargo->nome}";
            } elseif($nCargos == 1 || $i == $nCargos-1) {
                $cargos .= "{$cargo->nome}";
            } else {
                $cargos .= "{$cargo->nome}, ";
            }
            $i++;
        }

        return $cargos;
    }

    # Retorna o sexo "por extenso"
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

    # Retorna o sexo no formato padrão para uso no formulário do Collective
    public function formSexoAttribute(){
        return $this->attributes['sexo'];
    }

    public function setDataNascimentoAttribute($data){
        $this->attributes['data_nascimento'] = converterDataIngles($data);
    }

    public function getDataNascimentoAttribute(){
        return converterDataBrasil($this->attributes['data_nascimento']);
    }

    public function setRgAttribute($rg){
        $this->attributes['rg'] = limpaPontuacao($rg);
    }

    public function getRgAttribute(){
        return formataRG($this->attributes['rg']);
    }

    public function setCpfAttribute($cpf){
        $this->attributes['cpf'] = limpaPontuacao($cpf);
    }

    public function getCpfAttribute(){
        return formataCPF($this->attributes['cpf']);
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

}
