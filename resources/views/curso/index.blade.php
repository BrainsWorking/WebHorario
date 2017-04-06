@extends('layout.principal')

@section('title', 'Cursos')

@section('content')
@parent

<div class="col-lg-12 table-responsive">
	<table class="table table-condensed table-hover">
		<thead>

			@include('layout.barra_superior_index', ["route" => "curso.cadastrar"])

			<th class="text-center"></th>
			<th class="text-center">Nome</th>
			<th class="text-center">Sigla</th>
			<th class="text-center">Editar</th>
			<th class="text-center">Remover</th>
		</thead>

		
		<tbody>

			@forelse ($cursos as $curso)
			<tr class="table-line">
				<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
				<td class="text-center search"> {{$curso->nome}} </td>
				<td class="text-center search"> {{$curso->iniciais}} </td>
				<td class="text-center">
					<a href="{{ route('curso.editar', $curso->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
				</td>
				<td class="text-center">
					<a href="{{ route('curso.deletar', $curso->id) }}" class="table-delete"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<tr class="hidden-info">
				<td colspan="5">
					<div class="hidden-info-content">
						<p><b>Nome do Curso:</b> {{$curso->nome}}</p>
						<p><b>Sigla:</b> {{$curso->iniciais}}</p>
						<p><b>Turno:</b> {{$curso->turno->nome}}</p>
						<p><b>Disciplinas:</b></p>

						@foreach($curso->disciplinas as $disciplina)
						<span class="col-lg-3 text-center">{{ $disciplina['iniciais'] .' - '. $disciplina['nome'] }}</span>
						@endforeach
					</div>
				</td>
			</tr>

			@empty
			<tr class="text-center">
				<td colspan="5"><h4>Não há cursos cadastrados</h4></td>
			</tr>
			@endforelse

		</tbody>
	</table>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
@endsection