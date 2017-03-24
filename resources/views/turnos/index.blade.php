	@extends('layouts.template_principal')

	@section('title', 'Cursos')

	@section('content')
	@parent
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-striped">
			<thead>
				<h3 class="text-center page-header">TURNOS</h3>
				<th class="text-center">Turno</th>
				<th class="text-center">Quantidade de Aulas</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Remover</th>
			</thead>

			
			<tbody>
				<tr>
					<td class="text-center">Matutino</td>
					<td class="text-center">06</td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>

				<tr>
					<td class="text-center">Vespertino</td>
					<td class="text-center">04</td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>

				<tr>
					<td class="text-center">Noturno</td>
					<td class="text-center">04</td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>

				<!-- CASO LOOP NÃO TENHA VALORES PARA PREENCHIMENTO, INFORMAR AO USUARIO -->
			</tbody>
		</table>

		<a class="btn btn-success btn-lg" href="form_turno.blade.php"><span class="glyphicon glyphicon-plus"></span> Inserir</a>


	</div>
	@endsection