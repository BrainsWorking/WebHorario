@extends('layout.principal')
@section('title', 'Atribuição de Horários')
@section('content')

<h3>Atribuição de Horários - Análise e Desenvolvimento de Sistemas</h3> {{-- nome do curso --}}

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
			<a href="#" data-toggle="tooltip" data-html="true" data-placement='bottom' title="<div style='text-align:justify'><p>Selecione abaixo os dias da semana e horários que serão oferecidas as disciplinas.</p> <p>No quadro ao lado é possivel consultar os professores atribuidos às disciplinas, assim como os seus horários de preferencia.</p></div>">
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
					@php
					$disciplinas = [["nome"=>"Análise de Sistemas"],["nome"=>"Lógica de Programação"]]
					@endphp
					<td>
						{!! Form::select('disciplina_id', $disciplinas, null, ['placeholder'=>'','id' => 'disciplina_id', 'class' => 'disciplina form-control chosen-select']) !!}
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
			<a href="#" data-toggle="tooltip" data-html="true" data-placement='left' 
				title="<div style='text-align:justify'>
				<p>O quadro abaixo indica a quantidade de aulas semanais necessárias para cada disciplina do curso, para que se cumpra a grade curricular do curso</p>
				<p>Os quadros de disciplina indicam o nome da disciplina, o professor a ela atribuida e a quantidade de aulas semanais escolhidas. </p>
				<p>O status da seleção de horários por disciplina é exibido atráves de cores sendo que: a cor <b style='color:green'>verde</b> indica que o total de aulas semanais requiridas foi preenchido; <b style='color:orange'>laranja:</b> total de aulas semanais requiridas está abaixo da grade cadastrada; e <b style='color:red'>vermelho:</b> total de aulas semanais requiridas está acima da grade cadastrada</p>
				<p>É permitido que o progresso da atribuição seja salvo nas situações onde <b>todas</b> as disciplinas se encontrem na condição da cor <b style='color:orange'>laranja</b> e <b style='color:green'>verde</b>, ficando vetado as ações de salvar no caso da condição expressa pela cor <b style='color:red'>vermelha</b></p>
				</div>
				"
			>
				<span class="glyphicon glyphicon-info-sign"></span>
			</a>
		</div>
		<h4 class="text-center">Aulas Semanais</h4>
		<div id="atrb-disciplinas" >
			@foreach($disciplinas as $disciplina)
			<div class="atrb-disciplina">
				<div style="margin-left: 20px;">
					<p class="disciplina-nome">{{ $disciplina['nome'] }}</p>
					<p>
						<b>Professor:</b>Mario Tadashi
						<a href="#" data-toggle="tooltip" data-html="true" data-placement='top' 
							title="Preferencia de Horários:
									<p>Segunda - 19:00/19:55; 19:55/20:40</p>
									<p>Segunda - 19:00/19:55; 19:55/20:40</p>
									<p>Segunda - 19:00/19:55; 19:55/20:40</p>
									<p>Segunda - 19:00/19:55; 19:55/20:40</p>"
						> {{-- foreach $diasemana foreach $horarios --}}
							<span class="glyphicon glyphicon-info-sign"></span>
						</a>
					</p>
					<p><b>Carga Semanal:</b> <span class="carga-semanal">0</span>/<span class="carga-disciplina">4</span> aulas</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<div class="col-lg-12">
		<button id="form-salvar" type="submit" class="btn btn-success right">
			<span class="glyphicon glyphicon-floppy-disk"></span>
			Salvar
		</button>

		<a id="form-continuar" class="btn btn-primary right cancelar"><span class="glyphicon glyphicon-check"></span> Continuar Depois</a>
	</div>
</div>

{!! Form::close() !!}

@section('scripts')
<script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cadastro_atribuicao_horarios.js')}}"></script>
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