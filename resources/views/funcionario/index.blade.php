@extends('layout.principal')
@section('title', 'Pessoas')
@section('content')
@parent
	
<div class="col-lg-12 table-responsive">
	<table class="table table-condensed table-hover">
		<thead>
			@include('layout.barra_superior_index', ["route" => "funcionario.cadastrar"])
			<th class="text-center"></th>
			<th class="text-center">Nome</th>
			<th class="text-center">Cargo</th>
			<th class="text-center">Editar</th>
			<th class="text-center">Remover</th>
		</thead>

		<tbody>

		@forelse ($funcionarios as $funcionario)
			<tr class="table-line">
				<td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
				<td class="text-center search"> {{ $funcionario->nome }} </td>
				<td class="text-center search"> {{ $funcionario->cpf }} </td>
				<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
				<td class="text-center"><a href="" class="table-delete confirmar"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
			<tr class="hidden-info">
				<td colspan="5">
					<div class="hidden-info-content">
						<p><b>Nome:</b> {{ $funcionario->nome }} </p>
						<div class="col-lg-12 padding-left-0">
							<div class="col-lg-3 padding-left-0">
								<p><b>CPF:</b> {{ $funcionario->cpf }} </p>
							</div>
							<div class="col-lg-3 padding-left-0">
								<p><b>Nascimento:</b> {{ $funcionario->data_nascimento }} </p>
							</div>
						</div>
						<p><b>Endereço:</b> {{ $funcionario->endereco }} </p>
						<p><b>Email:</b> {{ $funcionario->email }} </p>
						<p><b>Cargo:</b> {{ $funcionario->cargo->nome }} </p>
					</div>
				</td>
			</tr>
			@empty
				<tr class="text-center">
					<td colspan="5"><h4>Não há funcionarios cadastrados</h4></td>
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