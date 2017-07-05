@extends('layout.principal')
@section('title', 'Atribuição de Disciplinas')
@section('content')

<h3>Atribuição de Disciplinas - {{$curso->nome}}</h3>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpa_inicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpa_fim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Semestre de Referência', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->nome, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Inicio', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->inicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Fim', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

{!! Form::open(['method' => 'post', 'class' => 'form', 'route' => 'atribuicao-disciplinas.salvar']) !!}

<div class="col-lg-12 padding-0">
	<div id="atrb-modulos" class="padding-left-0 col-lg-9">
		<div id="explicacoes">
			<label>CONFLITOS DE DISCIPLINAS</label>
			<a href="#" data-toggle="tooltip" data-placement='bottom' title="Podem ocorrer dois tipos de conflitos na atribuição das aulas: disciplina com conflito de interesses e disciplinas vazias, representadas pela cor a laranja e vermelho, respectivamente.">
				<span class="glyphicon glyphicon-info-sign"></span>
			</a>
		</div>
		@foreach($modulos as $modulo){{-- modulos/semestres --}}
		<div id="{{$modulo->id}}semestre" class="col-lg-3" style="padding: 0px">
			<h4 class='text-center'>{{$modulo->nome}}</h4>					
			@foreach($modulo['disciplinas'] as $disciplina){{-- disciplinas --}}
			<div class="atrb-disciplina">
				<p><b>Nome:</b> {{$disciplina->sigla}} - {{$disciplina->nome}}</p>
				<p class="aula-semana"><b>Aulas Semanais:</b> <span>{{$disciplina->aulas_semanais}}</span></p>
				<label for="professores">Professor: </label>
				{!! Form::select("funcionario_id[$modulo->id][$disciplina->id][]", $funcionarios, null, ['placeholder'=>'Escolha um professor','id' => 'funcionario_id', 'class' => 'professor form-control chosen-select']) !!}
			</div>
			@endforeach					
		</div>		
		@endforeach
	</div>

	<div class="col-lg-3">
		<div id="explicacoes">
			<label>QUADRO DE PROFESSORES</label>
			<a href="#" data-toggle="tooltip" data-placement='bottom' title="O quadro abaixo lista os professores, ordenados por sua quantidade de aulas de acordo com a atribuição ao lado. Neste quadro destacam-se os professores com o numero de aulas abaixo da média.">
				<span class="glyphicon glyphicon-info-sign"></span>
			</a>
		</div>
		<h4 class="text-center">Carga Horária Professores</h4>
		<div id="atrb-professores" >
			@foreach($funcionarios as $professor)
			<div class="atrb-professor">
				<span style="float: left; padding: 10px;" class="glyphicon glyphicon-user"></span>
				<div style="margin-left: 50px;">
					<p class="professor-nome">{{ $professor }}</p>
					<p><b>Carga Semanal:</b> <span class="carga-semanal">0</span> aulas</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<div class="col-lg-12">
		<button type="submit" class="btn btn-success right">
			<span class="glyphicon glyphicon-floppy-disk"></span>
			Salvar
		</button>

		<a class="btn btn-danger right cancelar"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
	</div>
</div>




{!! Form::close() !!}

@section('scripts')
<script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cadastro_atribuicao_disciplinas.js')}}"></script>
<script>
$(document).ready(function(){
	$(".chosen-select").chosen({
		no_results_text: "Nenhuma disciplina encontrada!",
		allow_single_deselect: true
	});
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{asset('css/fpa.css')}}">
@endsection

@endsection