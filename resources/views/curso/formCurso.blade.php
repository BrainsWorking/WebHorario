	@extends('layout.principal')

	@section('title', 'Turnos')

	@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/multi-select.css') }}">
	@endsection

	@section('content')
	@parent

	@if(isset($sucesso))
	<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><span class="glyphicon glyphicon-thumbs-up"></span> Sucesso!</strong> Cadastro realizado.
	</div>
	@elseif(isset($erro))
	<div class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><span class="glyphicon glyphicon-thumbs-down"></span> Erro!</strong> Ops, o seguinte erro ocorreu: {{$mensagem_erro}}.
	</div>
	@endif

	@if(isset($curso))
	{!! Form::model($curso, ['route' => ['curso.atualizar', $curso->id], 'method' => 'PUT']) !!}
	@else
	{!! Form::open(['route' => 'curso.salvar', 'method' => 'post']) !!}
	@endif

	<div class="col-lg-8 form-group padding-left-0">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', null, ['class' => 'form-control']) !!}
	</div>
	<div class="col-lg-4 form-group padding-right-0">
		{!! Form::label('iniciais', 'Sigla', ['class' => 'control-label']) !!}
		{!! Form::text('iniciais', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('turno', 'Turno', ['class' => 'control-label']) !!}
		{!! Form::select('turno_id', $turnos, null, ['placeholder' => 'Escolha um turno', 'required', 'id' => 'turno_id', 'class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('disciplinas', 'Disciplinas', ['class' => 'control-label']) !!}
		{!! Form::select('disciplina_id[]', $disciplinas, null, 
		['required', 'id' => 'disciplina_id', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/jquery.multi-select.js') }}"></script>
	<script>
	$('#disciplina_id').multiSelect();
	</script>
	@endsection