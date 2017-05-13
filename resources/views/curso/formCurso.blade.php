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

	<div class="form-group  padding-left-0">
		{!! Form::label('turno', 'Turno', ['class' => 'control-label']) !!}
		{!! Form::select('turno_id', $turnos, null, ['placeholder' => 'Escolha um turno', 'required', 'id' => 'turno_id', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('funcionario', 'Coordenador', ['class' => 'control-label']) !!}
		<a href="#" data-toggle="tooltip" data-placement='right' title="Caso o funcionário desejado não apareça na lista verifique se o mesmo está cadastrado no menu 'Funcionários' ou se o referido funcionário já não está cadastrado como coordenador de outro curso."><span class="glyphicon glyphicon-info-sign"></span></a>
		{!! Form::select('funcionario_id', $funcionarios, null, ['placeholder' => 'Escolha um coordenador', 'id' => 'funcionario_id', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		<h4>Semestres/Disciplinas</h4>
	</div>
	@if (isset($curso)) 
	<div class="col-lg-12 modulos" style="padding: 0px; margin-bottom: 15px;">
		<ul class='nav nav-tabs'>
			@foreach($curso->modulos as $modulo)
				@if($loop->first)
					<li class="active"><a data-toggle="pill" href="#{{$modulo->nome}}">{{$modulo->nome}}</a></li>	
				@else
					<li><a data-toggle="pill" href="#{{$modulo->nome}}">{{$modulo->nome}}</a></li>
				@endif
			@endforeach
					<li id="last"><a data-toggle="pill" href="#dp">DP</a></li>
					<li><a id="add-semestre" class="btn"><span class="glyphicon glyphicon-plus"></span></a></li>
					<li><a id="remove-semestre" class="btn"><span class="glyphicon glyphicon-minus"></span></a></li>
		</ul>

		<div class="tab-content">
			@foreach($curso->modulos as $modulo)
				@if($loop->first)
					<div id="{{$modulo->nome}}" class="disciplinas tab-pane fade in active">
				@else
					<div id="{{$modulo->nome}}" class="disciplinas tab-pane fade">
				@endif					
						<div class="control-group" style="margin-left: 15px;">
							<button type="button" class="btn btn-success add-field">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
							</button>
						</div>
						@foreach($modulo->disciplinas as $disciplina)
							<div class="disciplina">
								<div class="control-group form-group col-sm-5">
									{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
									{!! Form::text('disciplinas[nome][]', $disciplina->nome, ['class' => 'form-control', 'required']) !!}
								</div>
								<div class="control-group form-group col-sm-2">
									{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
									{!! Form::text('disciplinas[sigla][]', $disciplina->sigla, ['class' => 'form-control','maxlength' => '5', 'required']) !!}
								</div>
								<div class="control-group form-group col-sm-2">
									{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
									{!! Form::select('disciplinas[tipo_sala][]', ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], $disciplina->tipo_sala, ['class' => 'form-control']) !!}
								</div>              
								<div class="control-group form-group col-sm-2">
									{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
									{!! Form::text('disciplinas[aulas_semanais][]', $disciplina->aulas_semanais, ['class' => 'form-control', 'required']) !!}
								</div>
							</div>
						@endforeach
					</div>
			@endforeach
		</div>
	@else
	<div class="col-lg-12 modulos" style="padding: 0px; margin-bottom: 15px;">
		<ul class='nav nav-tabs'>
			<li class="active"><a data-toggle="pill" href="#semestre1">1° Semestre</a></li>
			<li id="last"><a data-toggle="pill" href="#dp">DP</a></li>
			<li><a id="add-semestre" class="btn"><span class="glyphicon glyphicon-plus"></span></a></li>
			<li><a id="remove-semestre" class="btn"><span class="glyphicon glyphicon-minus"></span></a></li>
		</ul>
		<div class="tab-content">
			<div id="semestre1" class="disciplinas tab-pane fade in active">
				<div class="control-group" style="margin-left: 15px;">
					<button type="button" class="btn btn-success add-field">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
					</button>
				</div>
				<div class="disciplina">
					<div class="control-group form-group col-sm-5">
						{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[nome][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[sigla][]', null, ['class' => 'form-control','maxlength' => '5', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
						{!! Form::select('disciplinas[tipo_sala][]', ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], null, ['class' => 'form-control']) !!}
					</div>              
					<div class="control-group form-group col-sm-2">
						{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[aulas_semanais][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
				</div>
			</div>

			<div id="dp" class="disciplinas tab-pane fade">
				<div class="control-group" style="margin-left: 15px;">
					<button type="button" class="btn btn-success add-field">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
					</button>
				</div>
				<div class="disciplina">
					<div class="control-group form-group col-sm-5">
						{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[nome][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[sigla][]', null, ['class' => 'form-control','maxlength' => '5', 'required']) !!}
					</div>
					<div class="control-group form-group col-sm-2">
						{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
						{!! Form::select('disciplinas[tipo_sala][]', ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], null, ['class' => 'form-control']) !!}
					</div>              
					<div class="control-group form-group col-sm-2">
						{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
						{!! Form::text('disciplinas[aulas_semanais][]', null, ['class' => 'form-control', 'required']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
		<button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
		<a class="btn btn-danger right cancelar" href="{{ route('cursos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script>
	$('#disciplina_id').multiSelect();
	</script>
	<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/cadastro_curso.js') }}"></script>
	@endsection