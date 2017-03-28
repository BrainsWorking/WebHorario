	@extends('layout.principal')

	@section('title', 'Turnos')

	@section('content')
	@parent

	{!! Form::open(['route' => 'turno.salvar', 'method' => 'post']) !!}

	<h1 class="text-center page-header"></h1>

	<div class="control-group">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', '', ['class' => 'form-control']) !!}
	</div>

	<div class="control-group">
		{!! Form::label('', 'Horários', ['class'=>'control-label']) !!}
	</div>

	<div class="horarios-turno">
		<div class="form-group col-lg-6">
			{!! Form::label('turnos_horarios', 'Início', ['class'=>'control-label col-lg-2']) !!}
			<div class="col-lg-10">
				{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control']) !!}
			</div>
		</div>

		<div class="form-group col-lg-6">
			{!! Form::label('turnos_horarios', 'Fim', ['class'=>'control-label col-lg-2']) !!}
			<div class="col-lg-10">
				{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control', 'maxlength' => '5']) !!}
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

	{{-- {!! Form::submit("Salvar", ["class" => 'btn btn-lg btn-success right ']) !!} --}}

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/cadastro_turno.js') }}"></script>
	@endsection