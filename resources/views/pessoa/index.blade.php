	@extends('layout.principal')

	@section('title', 'Pessoas')

	@section('content')
	@parent
	
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				
				@include('layout.barra_superior_index', ["route" => "pessoa.cadastrar"])

				<th class="text-center"></th>
				<th class="text-center">Nome</th>
				<th class="text-center">CPF</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Remover</th>
			</thead>


			<tbody>

				{{-- @forelse ($pessoas as $pessoa) --}}
				<tr class="table-line">
					<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
					<td class="text-center search"> Mario Tadashi Shimanuki </td>
					<td class="text-center search"> 000.000.000-00 </td>
					<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
					<td class="text-center"><a href="" class="table-delete confirmar"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
				<tr class="hidden-info">
					<td colspan="5">
						<div class="hidden-info-content">
							<p><b>Nome:</b> Mario Tadashi Shimanuki </p>
							<div class="col-lg-12 padding-left-0">
								<div class="col-lg-3 padding-left-0">
									<p><b>CPF:</b> 000.000.000-00 </p>
								</div>
								<div class="col-lg-3 padding-left-0">
									<p><b>RG:</b> 00.000.000-0 </p>
								</div>
								<div class="col-lg-3 padding-left-0">
									<p><b>D.N.:</b> 00/00/0000 </p>
								</div>
							</div>
							<p><b>Endereço:</b> Avenida Bahia, 1739 - Indaiá - Caraguatatuba/SP </p>
							<p><b>Cargo:</b> Professor </p>
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
		<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
		@endsection