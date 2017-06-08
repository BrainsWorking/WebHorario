@extends('layout.principal')
@section('title', 'Atribuição de Horários')
@section('content')

<h3>Atribuição de Horários - Análise e Desenvolvimento de Sistemas</h3>

<div class="col-lg-6 form-group padding-left-0">
	{!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
	{!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Semestre de Referência', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Data de Inicio', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Data de Fim', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

{!! Form::open(['method' => 'post', 'class' => 'form']) !!}

<div class="col-lg-12 padding-0">
	<div id="atrb-modulos" class="padding-left-0 col-lg-9">
		<div id="explicacoes">
			<label>SELEÇÃO DE HORÁRIOS</label>
			<a href="#" data-toggle="tooltip" data-placement='bottom' title="Texto">
				<span class="glyphicon glyphicon-info-sign"></span>
			</a>
		</div>
		@php
		$modulos = ["1° Semestre", "2° Semestre", "3° Semestre", "4° Semestre"]
		@endphp
		@foreach($modulos as $modulo) {{-- modulos/semestres --}}
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th></th>
					@php
					$dias_semana = ["Seg", "Ter", "Qua", "Qui", "Sex"];
					@endphp
					@foreach($dias_semana as $dia)
					<th class="text-center">{{$dia}}</th>
					@endforeach						
				</tr>
			</thead>

			<tbody>
				@php
				$horarios = ["19:00 - 19:40", "20:00 - 19:40", "21:00 - 21:40", "22:00 - 22:40"]
				@endphp
				@foreach($horarios as $horario)
				<tr>					
					@if($loop->first)
					<th style="vertical-align: middle; text-align: center"rowspan="{{count($horarios)}}">{{$modulo}}</th> {{-- count(qtd_horarios) --}}
					@endif
					@foreach($dias_semana as $dia)
					<td>
						<select name="componentes[]" class="chosen-select" data-placeholder=" ">
							<option value=''></option>
							@php
							$disciplinas = [["id"=>'1', "nome"=>"Análise de Sistemas"],["id"=>'1', "nome"=>"Lógica de Programação"]]
							@endphp
							@foreach($disciplinas as $disciplina)
							<option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
							@endforeach
							<!--optgroup label="ADS">
						</optgroup -->
					</select>
				</td>
				@endforeach

			</tr>
			@endforeach
		</tbody>
	</table>
	@endforeach
</div>

<div class="col-lg-3">
	<div id="explicacoes">
		<label>QUADRO DE DISCIPLINAS</label>
		<a href="#" data-toggle="tooltip" data-placement='bottom' title="Texto">
			<span class="glyphicon glyphicon-info-sign"></span>
		</a>
	</div>
	<h4 class="text-center">Aulas Semanais</h4>
	<div id="atrb-disciplinas" >
		@foreach($disciplinas as $disciplina)
		<div class="atrb-disciplina">
			<div style="margin-left: 50px;">
				<p class="disciplina-nome">{{ $disciplina['nome'] }}</p>
				<p>
					<b>Professor:</b>Mario Tadashi
					<a href="#" data-toggle="tooltip" data-placement='bottom' title="Texto">
						<span class="glyphicon glyphicon-info-sign"></span>
					</a>
				</p>
				<p><b>Carga Semanal:</b> <span class="carga-semanal">0</span>/<span>4</span> aulas</p>
			</div>
		</div>
		@endforeach
	</div>
</div>


<div class="col-lg-12">
	<button type="submit" class="btn btn-success right">
		<span class="glyphicon glyphicon-floppy-disk"></span>
		Salvar
	</button>

	<a class="btn btn-danger right cancelar"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
</div>
</div>

{!! Form::close() !!}

@section('scripts')
<script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cadastro_atribuicao_disciplinas.js')}}"></script>
<script>
$(document).ready(function(){
	$(".chosen-select").chosen({
		no_results_text: "Nenhuma disciplina encontrada!",
		allow_single_deselect: true
	});
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{asset('css/fpa.css')}}">
@endsection

@endsection