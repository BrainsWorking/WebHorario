	@extends('layout.principal')

	@section('title', 'Disciplinas')

	@section('content')
	@parent
	<div class="col-lg-12 table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				<div class="padding-right-0 padding-left-0 top-bar">
					<div class="col-sm-8 padding-left-0">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
							<input type="text" class="form-control input-filter" placeholder="Pesquisar">
						</div>
					</div>

					<div class="col-sm-4 padding-right-0">
						<a class="btn btn-success right col-sm-12" href="{{ route('disciplina.cadastrar') }}"><span
							class="glyphicon glyphicon-plus"></span> Cadastrar</a>
						</div>
					</div>


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
						<td class="text-center"><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
						<td class="text-center"><a href="" class="table-delete"><span class="glyphicon glyphicon-remove"></span></a></td>
					</tr>
					<tr class="hidden-info">
						<td colspan="5">
							<p><b>Nome da Disciplina:</b> {{$disciplina->nome}}</p>
							<p><b>Sigla:</b> {{$disciplina->iniciais}}</p>
							<p><b>Carga Horária:</b> {{$disciplina->cargaHoraria}}</p>
						</td>
					</tr>

					@empty
					<h3 class="text-center">Não há cadastros</h3>
					@endforelse

				</tbody>
			</table>

		</div>
		@endsection

		@section('scripts')
		<script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
		@endsection