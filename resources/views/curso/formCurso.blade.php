	@extends('layout.principal')

	@section('title', 'Cursos')

	@section('content')
	@parent

	@if(isset($curso))
	{!! Form::model($curso, ['route' => ['curso.atualizar', $curso->id], 'method' => 'PUT']) !!}
	@else
	{!! Form::open(['route' => 'curso.salvar', 'method' => 'post']) !!}
	@endif

	<div class="col-lg-8 form-group padding-left-0">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
	</div>
	<div class="col-lg-4 form-group padding-right-0">
		{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
		{!! Form::text('sigla', null, ['class' => 'form-control', 'required']) !!}
	</div>

	<div class="col-lg-8 form-group  padding-left-0">
		{!! Form::label('turno', 'Turno', ['class' => 'control-label']) !!}
		{!! Form::select('turno_id', $turnos, null, ['placeholder' => 'Escolha um turno', 'required', 'id' => 'turno_id', 'class' => 'form-control']) !!}
	</div>

	<div class="col-lg-4 form-group padding-right-0">
		{!! Form::label('modulos', 'Quantidade de Semestres', ['class' => 'control-label']) !!}
		{!! Form::number('modulos', null, ['required', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('funcionario', 'Coordenador', ['class' => 'control-label']) !!}
		<a href="#" data-toggle="tooltip" data-placement='right' title="Caso o funcionário desejado não apareça na lista verifique se o mesmo está cadastrado no menu 'Funcionários' ou se o referido funcionário já não está cadastrado como coordenador de outro curso."><span class="glyphicon glyphicon-info-sign"></span></a>
		{!! Form::select('funcionario_id', $funcionarios, null, ['placeholder' => 'Escolha um coordenador', 'id' => 'funcionario_id', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		<h4>Disciplinas</h4>
	</div>

	<div class="col-lg-12 " style="padding: 0px; margin-bottom: 15px;">
		<ul class='nav nav-tabs'>
			<li class="active"><a data-toggle='pill' href='#semestre1'>1° Semestre</a></li>
			<li><a data-toggle='pill' href='#semestre2'>2° Semestre</a></li>
			<li><a data-toggle='pill' href='#dp'>DP</a></li>
		</ul>
		<div class="tab-content">
			<div id="semestre1" class="tab-pane fade in active">

				<div class="control-group" style="margin-left: 15px;">
					<button type="button" class="btn btn-success add-field">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
					</button>
				</div>

				<div id="disciplina">
					<div class="control-group form-group col-sm-6">
						{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
						{!! Form::text('nome[semestre1][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
						{!! Form::text('sigla[semestre1][]', null, ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('tipoSala', 'Tipo de Sala', ['class' => 'control-label', 'required']) !!}
						<select class="form-control" name="tipoSala[semestre1][]">
							<option>Sala Comum</option>
							<option>Laboratório de Informática</option>
						</select>
					</div>				
					<div class="control-group form-group col-sm-2">
						{!! Form::label('aulasSemanais', 'Aulas/semana', ['class' => 'control-label']) !!}
						{!! Form::text('aulasSemanais[]', null, ['class' => 'form-control', 'required']) !!}
					</div>			
				</div>

				<div id="disciplina">
					<div class="control-group form-group col-sm-6">						
						{!! Form::text('nome[semestre1][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">						
						{!! Form::text('sigla[semestre1][]', null, ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">						
						<select class="form-control" name="tipoSala[semestre1][]">
							<option>Sala Comum</option>
							<option>Laboratório de Informática</option>
						</select>
					</div>				
					<div class="control-group form-group col-sm-2">						
						{!! Form::text('aulasSemanais[]', null, ['class' => 'form-control', 'required']) !!}
					</div>			
				</div>

			</div>

			<div id="semestre2" class="tab-pane fade">
				Semestre 2
			</div>

			<div id="dp" class="tab-pane fade">
				Semestre DP
			</div>
		</div>
	</div>



	<button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
	<a class="btn btn-danger right cancelar" href="{{ route('cursos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script>
	$('#disciplina_id').multiSelect();
	</script>
	<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
	@endsection