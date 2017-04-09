	@extends('layout.principal')

	@section('title', 'Semestres')

	@section('content')
	@parent
	
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				
				@include('layout.barra_superior_index', ["route" => "semestre.cadastrar"])

				<th class="text-center"></th>
				<th class="text-center">Identificação</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Remover</th>
			</thead>


			<tbody>

				@forelse ($semestres as $semestre)
				<tr class="table-line">
					<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
					<td class="text-center search"> {{ $semestre->nome }} </td>
					<td class="text-center"><a href="{{ route('semestre.editar', $semestre->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href="{{ route('semestre.deletar', $semestre->id) }}" class="table-delete confirmar"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				<tr class="hidden-info">
					<td colspan="5">
						<div class="hidden-info-content">
							<p><b>Identificação do Semestre:</b> {{ $semestre->nome }} </p>
							<p><b>Data de Início:</b> {{ converterDataBrasil($semestre->inicio) }} </p>
							<p><b>Data Fim:</b> {{ converterDataBrasil($semestre->fim) }} </p>
						</div>
					</td>
				</tr>

				@empty
					<tr class="text-center">
						<td colspan="5"><h4>Não há semestres cadastradas</h4></td>
					</tr>
				@endforelse

				</tbody>
			</table>

		</div>
		@endsection

		@section('scripts')
		<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
		@endsection