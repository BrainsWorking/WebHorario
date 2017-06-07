@extends('layout.principal')
@section('title', 'Atribuição de Disciplinas')
@section('content')

<div class="col-lg-12 horario-professor" style="display:none">
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

<div class="col-lg-12 horario-professor">
	<div class="text-center" style="text-transform: uppercase">
		<h4 class="text-center">HORÁRIO DE AULAS - 2017-1</h4>
		<h3>Tecnologia Em Análise e Desenvolvimento de Sistemas</h3>
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
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Disciplina</th>
							<th>Professor</th>
							<th>Sala</th>
						</tr>
					</thead>
					<tbody>
						@for ($i=0; $i < 4; $i++)

						<tr>
							<td>{{$i+1}}</td>
							<td>LOP1</td>
							<td>Shimanuki</td>
							<td>214</td>
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