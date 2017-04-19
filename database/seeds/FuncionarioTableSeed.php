
<?php
use Illuminate\Database\Seeder;
use App\Models\Funcionario;
class FuncionarioTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcionario::create([
            'nome' 				=> 'Administrador',
            'sexo' 				=> 'M',
            'cpf'				=> '111.111.111-11',
            'data_nascimento'	=> '2017/12/12',
            'endereco'			=> 'Endereço',
            'foto'				=> 'img/null.jpg',
            'email'             => 'admin@gmail.com',
            'prontuario' 		=> '1512312',
            'email' => 'admin@admin.com',
            'password' 			=> bcrypt('123456')
        ]);
    }
}