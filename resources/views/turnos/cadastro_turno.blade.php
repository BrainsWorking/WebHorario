	@extends('layouts.template_principal')

	@section('title', 'Turnos')

	@section('content')
	@parent

	<form role="form" method="POST" action="#" validate>
		
		<h1 class="text-center page-header">Cadastro de Turno</h1>

		<div class="control-group">
			<label for="name" class="control-label">Nome do Turno</label>
			<input type="text" name="name" class="form-control" required>
		</div>

		<div class="control-group">
			<label for="name" class="control-label">Quantidade de Aulas</label>
			<input type="number" name="name" class="form-control" required>
		</div>

		<input type="submit" class="btn btn-success right" value="Salvar">

	</form>

	@endsection