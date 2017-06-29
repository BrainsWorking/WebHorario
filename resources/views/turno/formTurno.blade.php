	@extends('layout.principal')

	@section('title', 'Turnos')

	@section('content')
	@parent

	@if(isset($turno))
	{!! Form::model($turno, ['route'=>['turno.atualizar', $turno->id], 'method'=>'PUT']) !!}
	@else
	{!! Form::open(['route' => 'turno.salvar', 'method' => 'post']) !!}
	@endif
	
	<div class="control-group">
		{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
	</div>

	<div class="control-group">
		<button type="button" class="btn btn-success add-field">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			Adicionar aula
		</button>
	</div>

	<div class="horarios-turno col-lg-12">
		@if(isset($turno))
		@foreach($turno->horarios as $key => $horario)

		<?php 
		$inicio = "horario[$horario->id][inicio]";
		$fim    = "horario[$horario->id][fim]";
		?>

		<div class="row">
			<div class="col-lg-1 padding-left-0"><label class="index" id="{{$horario->id}}">Aula {{$key+1}}</label></div>
			<div class="col-lg-5">
				<div class="form-group col-lg-6">
					{!! Form::text($inicio, $horario->inicio, ['class'=>'form-control hora', 'placeholder'=>'Início' ,'minlength' => '5', 'required']) !!}
				</div>

				<div class="form-group col-lg-6">
					{!! Form::text($fim, $horario->fim, ['class'=>'form-control hora', 'placeholder'=>'Fim' ,'minlength' => '5', 'required']) !!}
				</div>
			</div>
			<div class="col-lg-1 padding-right-0 remove-field">
				<button type="button" class="btn btn-danger btn-sm">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
            </div>
		</div>
		@endforeach
		@else

		<div class="row">
			<div class="col-lg-1 padding-left-0"><label id="1" class="index">Aula 1</label></div>
			<div class="col-lg-5">
				<div class="form-group col-lg-6">
					{!! Form::text('horario[1][inicio]', null, ['class'=>'form-control hora', 'placeholder'=>'Início' ,'minlength' => '5', 'required']) !!}
				</div>

				<div class="form-group col-lg-6">
					{!! Form::text('horario[1][fim]', null, ['class'=>'form-control hora', 'placeholder'=>'Fim' ,'minlength' => '5', 'required']) !!}
				</div>
			</div>
			<div class="col-lg-1 padding-right-0">
			</div>
		</div>

		@endif
	</div>

	<button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
	<a class="btn btn-danger right cancelar" href="{{ route('turnos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

	{!! Form::close() !!}

	@endsection

	@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/cadastro_turno.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.hora').mask('00:00');
        });
    </script>
	@endsection
