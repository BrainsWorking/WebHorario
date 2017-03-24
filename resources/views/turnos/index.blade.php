	@extends('layouts.template_principal')

	@section('title', 'Cursos')

	@section('content')
	@parent
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-striped">
			<thead>
				<h1 class="text-center page-header"><span class="glyphicon glyphicon-time"></span> TURNOS</h1>
				<a class="btn btn-success btn-lg right" href="/turno/cadastrar"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 barra-pesquisa">
					<form role="form">
						<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
								<input type="text" class="form-control" placeholder="Pesquisar">
						</div>
					</form>
				</div>

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
				
			</tbody>
		</table>

	</div>
	@endsection