@extends('layout.principal')
@section('title', 'Atribuição de Disciplinas')
@section('content')

<h3>Atribuição de Disciplinas - Análise e Desenvolvimento de Sistemas</h3>

<div class="col-lg-6 form-group padding-left-0">
	{!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
	{!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Semestre de Referência', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Data de Inicio', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
	{!! Form::label('', 'Data de Fim', ['class' => 'control-label']) !!}
	{!! Form::text('', '04/05/1995', ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

{!! Form::open(['method' => 'post', 'class' => 'form']) !!}

<div class="col-lg-12">
	<div class="col-lg-9 padding-left-0" style="margin-bottom: 20px;">
		<div class="atrb-modulos">
			<ul class='nav nav-tabs'>
				<li class="active"><a data-toggle="pill" href="#1semestre">1° Semestre</a></li>
				<li><a data-toggle="pill" href="#2semestre">2° Semestre</a></li>
				<li><a data-toggle="pill" href="#3semestre">3° Semestre</a></li>
			</ul>
			<div class="tab-content">
				@for($x = 1; $x <= 3; $x++)
				<div id="{{$x}}semestre" class="disciplinas tab-pane fade in active">
					<div class="atrb-semestre col-lg-12">
						@for($i = 0; $i < 5; $i++)
						<div class="atrb-disciplina">
							<p><b>Nome:</b> LOPI - Lógica de Programação</p>
							<p><b>Aulas Semanais:</b> 4</p>
							<label for="professores">Professor: </label>
							<select name="professores" class="chosen-select">
								<option selected>Escolha um professor</option>
								<optgroup label="Interessados">
									<option>Mario Tadashi Shimanuki</option>
									<option>Mario Tadashi Shimanuki</option>
								</optgroup>
								<optgroup label="Outros">
									<option>Mario Tadashi Shimanuki</option>
									<option>Mario Tadashi Shimanuki</option>
								</optgroup>
							</select>
							<label for="horarios">Horários: </label>
							<select name="horarios"  class="chosen-select">
								<option selected></option>
								<optgroup label="Quinta">
									<option>19:00 - 19:55</option>
									<option>19:00 - 19:55</option>
								</optgroup>
								<optgroup label="Sexta">
									<option>19:00 - 19:55</option>
									<option>19:00 - 19:55</option>
								</optgroup>
							</select>
						</div>
						@endfor
					</div>		
				</div>		
				@endfor
			</div>
		</div>
	</div>

	<div class="col-lg-3">		
		<h4 style="margin-bottom: 30px;">Carga Horária Professores</h4>
		<div id="atrb-professores" >
			@for($y = 0; $y < 10; $y++)
			<div class="atrb-professor">
				<span style="float: left; padding: 10px;" class="glyphicon glyphicon-user"></span>
				<div style="margin-left: 50px;">
					<p>Mario Tadashi Shimanuki</p>
					<p><b>Carga Semanal:</b> 36 aulas</p>
				</div>
			</div>
			@endfor
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
<script type="text/javascript" src="{{asset('js/fpa.js')}}"></script>
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