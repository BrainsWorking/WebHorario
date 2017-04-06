	@extends('layout.principal')

	@section('title', 'Disciplinas')

	@section('content')
	@parent
	
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				
				@include('layout.barra_superior_index', ["route" => "disciplina.cadastrar"])

				<th class="text-center"></th>
				<th class="text-center">Nome</th>
				<th class="text-center">Sigla</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Remover</th>
			</thead>


			<tbody>

				@forelse ($disciplinas as $disciplina)
				<tr class="table-line">
					<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
					<td class="text-center search"> {{$disciplina->nome}} </td>
					<td class="text-center search"> {{$disciplina->iniciais}} </td>
					<td class="text-center"><a href="{{ route('disciplina.editar', $disciplina->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href="{{ route('disciplina.deletar', $disciplina->id) }}" class="table-delete"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				<tr class="hidden-info">
					<td colspan="5">
						<div class="hidden-info-content">
							<p><b>Nome da Disciplina:</b> {{$disciplina->nome}}</p>
							<p><b>Sigla:</b> {{$disciplina->iniciais}}</p>
							<p><b>Carga Horária:</b> {{$disciplina->cargaHoraria}}</p>
						</div>
					</td>
				</tr>

				@empty
				<tr class="text-center">
					<td colspan="5"><h4>Não há disciplinas cadastradas</h4></td>
				</tr>
				@endforelse

			</tbody>
		</table>

	</div>
	@endsection

	@section('scripts')
	<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
	@endsection