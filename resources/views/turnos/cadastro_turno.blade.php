<!-- ESSAS LINHAS PODEM SER REMOVIDAS QUANDO INTEGRADAS AO TEMPLATE PRINCIPAL -->
<link rel="stylesheet" type="text/css" href="../app.public/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../app.public/css/style.css">
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

	@extends('views.main_template')

	@section('title', 'Cursos')

	@section('content')
		@parent

	<form role="form" method="POST" action="#" validate>
		
		<h3 class="text-center">Cadastrar Novo Turno</h3>

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

</div>