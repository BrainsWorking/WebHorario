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

				{{-- @forelse ($semestres as $semestre) --}}
				<tr class="table-line">
					<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
					<td class="text-center search"> 2017-1 </td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href="" class="table-delete"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				<tr class="hidden-info">
					<td colspan="5">
						<div class="hidden-info-content">
							<p><b>Identificação do Semestre:</b> 2017-1 </p>
							<p><b>Data de Início:</b> 01/01/2017 </p>
							<p><b>Data Fim:</b> 30/06/2017 </p>
						</div>
					</td>
				</tr>

				{{-- @empty --}}
					{{-- <tr class="text-center">
						<td colspan="5"><h4>Não há semestres cadastradas</h4></td>
					</tr>
					@endforelse --}}

				</tbody>
			</table>

		</div>
		@endsection

		@section('scripts')
		<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
		@endsection