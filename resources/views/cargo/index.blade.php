	@extends('layout.principal')

	@section('title', 'Cargos')

	@section('content')
	@parent
	
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				
				@include('layout.barra_superior_index', ["route" => "cargo.cadastrar"])

				<th class="text-center">Nome</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Remover</th>
			</thead>


			<tbody>

				{{-- @forelse ($cargos as $cargo) --}}
				<tr class="table-line">
					<td class="text-center search"> Professor </td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href="" class="table-delete"><span class="glyphicon glyphicon-remove">
					</span></a></td>
				</tr>

				{{-- @empty --}}
					{{-- <tr class="text-center">
						<td colspan="5"><h4>Não há cargos cadastrados</h4></td>
					</tr>
					@endforelse --}}

				</tbody>
			</table>

		</div>
		@endsection

		@section('scripts')
		<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
		@endsection