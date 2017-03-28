	@extends('layout.principal')

	@section('title', 'Turnos')

	@section('content')
	@parent


	@if(isset($turno))
	{!! Form::model($turno, ['route'=>['turno.atualizar', $turno->id], 'method'=>'PUT']) !!}
	@else
	{!! Form::open(['route' => 'turno.salvar', 'method' => 'post']) !!}
	@endif

	<h1 class="text-center page-header"></h1>

	<div class="control-group">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', '', ['class' => 'form-control']) !!}
	</div>

	<div class="control-group">
		<button type="button" class="btn btn-success add-field">Adicionar Horário de Aula</button>
	</div>

	<div class="horarios-turno col-lg-12">
		<div class="row">
			<div class="col-lg-2 padding-left-0"><label>Aula 01</label></div>
			<div class="col-lg-9">
				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control', 'placeholder'=>'Início', 'maxlength' => '5']) !!}
				</div>

				<div class="form-group col-lg-6">
					{!! Form::text('turnos_horarios[]', '', ['class'=>'form-control', 'placeholder'=>'Fim', 'maxlength' => '5']) !!}
				</div>
			</div>
			<div class="col-lg-1">
				<button type="button" class="btn btn-danger btn-sm paddin-right-0"><span class="glyphicon glyphicon-remove"></span></button>
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