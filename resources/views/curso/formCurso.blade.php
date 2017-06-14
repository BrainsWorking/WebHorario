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
			<li class="active"><a data-toggle="pill" href="#sem{{$modulo->id}}">{{$modulo->nome}}</a></li>	
			@elseif($loop->last)
			<li id="last"><a data-toggle="pill" href="#sem{{$modulo->id}}">{{$modulo->nome}}</a></li>
			@else
			<li><a data-toggle="pill" href="#sem{{$modulo->id}}">{{$modulo->nome}}</a></li>
			@endif
			@endforeach
			<li><a id="add-semestre" class="btn"><span class="glyphicon glyphicon-plus"></span></a></li>
		</ul>

		<div class="tab-content">
			@foreach($curso->modulos as $modulo)
			@if($loop->first)
			<div id="sem{{$modulo->id}}" class="disciplinas tab-pane fade in active" data-modulo="{{$modulo->id}}">
				@else
				<div id="sem{{$modulo->id}}" class="disciplinas tab-pane fade" data-modulo="{{$modulo->id}}">
					@endif					
					<input type="hidden" name="modulo[{{$modulo->id}}][id]" value="{{$modulo->id}}" hidden/>
					<input type="hidden" name="modulo[{{$modulo->id}}][nome]" value="{{$modulo->nome}}" hidden/>
					<div class="control-group" style="margin-left: 15px;">
						<button type="button" class="btn btn-success add-field">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
						</button>
						<button type="button" data-target="sem{{$modulo->id}}" class="btn btn-default remove-semestre" style="float: right">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Remover este semestre
						</button>
					</div>
					@foreach($modulo->disciplinas as $disciplina)
					<div class="disciplina">
						<div class="control-group form-group col-sm-3">
							{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
							{!! Form::text("modulo[$modulo->id][disciplinas][nome][$disciplina->id]", $disciplina->nome, ['class' => 'form-control', 'required']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
							{!! Form::text("modulo[$modulo->id][disciplinas][sigla][$disciplina->id]", $disciplina->sigla, ['class' => 'form-control','maxlength' => '5', 'required']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
							{!! Form::select("modulo[$modulo->id][disciplinas][tipo_sala][$disciplina->id]", ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], null, ['class' => 'form-control']) !!}
						</div>              
						<div class="control-group form-group col-sm-2">
							{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
							{!! Form::text("modulo[$modulo->id][disciplinas][aulas_semanais][$disciplina->id]", $disciplina->aulas_semanais, ['class' => 'form-control', 'required']) !!}
						</div>
                        <div class="control-group form-group col-sm-2">
							{!! Form::label('quantidade_professores', 'Quantidade profs', ['class' => 'control-label']) !!}
							{!! Form::text("modulo[$modulo->id][disciplinas][quantidade_professores][$disciplina->id]", $disciplina->quantidade_professores, ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
					@endforeach
				</div>
				@endforeach
			</div>
		</div>
		@else
		<div class="col-lg-12 modulos" style="padding: 0px; margin-bottom: 15px;">
			<ul class='nav nav-tabs'>
				<li class="active"><a data-toggle="pill" href="#semestre1">1° Semestre</a></li>
				{{-- <li id="last"><a data-toggle="pill" href="#dp">DP</a></li> --}}
				<li hidden id="last"></li>
				<li><a id="add-semestre" class="btn"><span class="glyphicon glyphicon-plus"></span></a></li>
			</ul>
			<div class="tab-content">
				<div id="semestre1" class="disciplinas tab-pane fade in active" data-modulo="1">
					<input type="hidden" name="modulo_novo[1][nome]" value="1º Semestre" hidden/>
					<div class="control-group" style="margin-left: 15px;">
						<button type="button" class="btn btn-success add-field">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
						</button>
						<button type="button" data-target='semestre1' class="btn btn-default remove-semestre" style="float: right; margin-top: 10px;">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Remover este semestre
						</button>
					</div>
					<div class="disciplina">
						<div class="control-group form-group col-sm-3">
							{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[1][disciplinas][nome][]", null, ['class' => 'form-control', 'required']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[1][disciplinas][sigla][]", null, ['class' => 'form-control','maxlength' => '5', 'required']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
							{!! Form::select("modulo_novo[1][disciplinas][tipo_sala][]", ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], null, ['class' => 'form-control']) !!}
						</div>              
						<div class="control-group form-group col-sm-2">
							{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[1][disciplinas][aulas_semanais][]", null, ['class' => 'form-control', 'required']) !!}
						</div>
                        <div class="control-group form-group col-sm-2">
							{!! Form::label('quantidade_professores', 'Quantidade profs', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[1][disciplinas][quantidade_professores][]", null, ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
				</div>

				{{-- <div id="dp" class="disciplinas tab-pane fade" data-modulo="0">
					<input type="hidden" name="modulo_novo[0][nome]" value="DP" hidden/>
					<div class="control-group" style="margin-left: 15px;">
						<button type="button" class="btn btn-success add-field">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
						</button>
					</div>
					<div class="disciplina">
						<div class="control-group form-group col-sm-3">
							{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[0][disciplinas][nome][]", null, ['class' => 'form-control']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[0][disciplinas][sigla][]", null, ['class' => 'form-control','maxlength' => '5']) !!}
						</div>
						<div class="control-group form-group col-sm-2">
							{!! Form::label('tipoSala', 'Tipo Sala', ['class' => 'control-label']) !!}
							{!! Form::select("modulo_novo[0][disciplinas][tipo_sala][]", ['1' => 'Sala Comum', '2' => 'Laboratório de Informática'], null, ['class' => 'form-control']) !!}
						</div>              
						<div class="control-group form-group col-sm-2">
							{!! Form::label('aulas_semanais', 'Aulas/Semana', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[0][disciplinas][aulas_semanais][]", null, ['class' => 'form-control']) !!}
						</div>
                        <div class="control-group form-group col-sm-2">
							{!! Form::label('quantidade_professores', 'Quantidade profs', ['class' => 'control-label']) !!}
							{!! Form::text("modulo_novo[0][disciplinas][quantidade_professores][]", null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> --}}
			</div>
		</div>
		@endif
		<button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
		<a class="btn btn-danger right cancelar" href="{{ route('cursos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

		{!! Form::close() !!}

		@endsection

		@section('scripts')
		<script>
		var i = {{ isset($curso) ? $curso->modulos->count() : '2' }};
		$('#disciplina_id').multiSelect();
		</script>
		<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/cadastro_curso.js') }}"></script>
		@endsection