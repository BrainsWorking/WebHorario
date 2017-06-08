@extends('layout.principal')
@section('title', 'Quadro de Horários')
@section('content')

<div class="col-lg-12 horario-professor">
	<div class="text-center" style="text-transform: uppercase">
		<h4 class="text-center">HORÁRIO DE AULAS - 2017-1</h4>
		<h3>Horário Semanal Professor</h3>
	</div>

	<div class="dias-semanas">
		@php
		$diasSemana = ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
		@endphp
		@foreach ($diasSemana as $dia)
		<div class="dia-semana">
			<div class="text-center" style="color: white; text-transform: uppercase; font-weight: bold; padding: 5px;">
				<span>{{$dia}}</span>
			</div>
			@for ($i=0; $i < 5; $i++)
			<div class="vsl-disciplina">
				<div class="vsl-horario text-center">
					<span>19:00</span>
					<span>19:40</span>
				</div>
				<div class="text-center">
					<p style="font-weight:bolder; margin:0">LOP1</p>
					<p style="margin:0">ADS</p>
				</div>
			</div>
			@endfor
		</div>
		@endforeach
	</div>
</div>

<div class="col-lg-12 horario-curso">
	<div class="text-center" style="text-transform: uppercase">
		<h4 class="text-center">HORÁRIO DE AULAS - 2017-1</h4>
		<h3>Tecnologia Em Análise e Desenvolvimento de Sistemas</h3>
	</div>

	<div class="col-lg-12 quadro-horarios hidden-print">
		<h5 class="text-center" style="text-transform: uppercase; font-weight:bold">PERÍODO NOTURNO</h5> {{-- nome turno --}}
		@php
		$horarios = ["19:40 às 19:40", "19:40 às 19:40", "19:40 às 19:40", "19:40 às 19:40"];
		@endphp
		@foreach ($horarios as $horario) {{-- $horarios --}}
		<div style="float:left; margin: 0px 5px 5px 0px; border: 1px double black">
			<span style="font-weight:bolder; background-color: black; color:white; padding: 0px 5px 1px 5px;">{{$loop->index+1}}</span>
			<span style="margin:1px">{{$horario}}</span>
		</div>
		@endforeach
	</div>

	<div class="dias-semanas">
		@php
		$modulos = ["1° Semestre", "2° Semestre", "3° Semestre", "4° Semestre", "5° Semestre", "DP"];
		@endphp
		@foreach ($modulos as $modulo)
		<div class="vsl-modulo">
			<div class="text-center" style="color: white; text-transform: uppercase; font-weight: bold; padding: 5px;">
				<span>{{$modulo}}</span>
			</div>
			@php
			$diasSemana = ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
			@endphp
			@foreach($diasSemana as $dia)
			<div class="vsl-dia-semana">
				<table class="table text-center">
					<thead style="font-size: 10px;">
						<tr>
							<th></th>
							<th></th>
							<th class="text-center" style="padding:2px;">Disciplina</th>
							<th class="text-center" style="padding:2px;">Professor</th>
							<th class="text-center" style="padding:2px;">Sala</th>
						</tr>
					</thead>
					<tbody>
						@for ($i=0; $i < 4; $i++) {{-- $horarios --}}
						<tr>
							@if($i == 0) {{-- trocar por $loop->first --}}
							<th rowspan="4" class="rotate-90" style="padding: 0px"> {{-- count($horarios) --}}
								<span>{{$dia}}</span>
							</th>
							@endif
							<td style="padding:2px;">{{$i+1}}</td>
							<td style="padding:2px;">LOP1</td>
							<td style="padding:2px;">Shimanuki</td>
							<td style="padding:2px;">214</td>
						</tr>
						@endfor
					</tbody>
				</table>
			</div>
			@endforeach
		</div>
		@endforeach
	</div>
</div>


@endsection