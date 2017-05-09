@extends('layout.principal')

@section('title', 'Funcionários')

@section('content')
@parent

<div class="">
    @if(isset($funcionario))
    {!! Form::model($funcionario, ['route'=>['funcionario.atualizar', $funcionario->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post', 'files' => true, 'route'=>'funcionario.salvar']) !!}
    @endif

    <div class="control-group form-group col-lg-8 padding-left-0">
        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-4 padding-right-0">
        {!! Form::label('foto', 'Foto', ['class' => 'control-label']) !!}
        {!! Form::file('foto', ['class' => 'form-control']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-left-0">
        {!! Form::label('rg', 'RG', ['class' => 'control-label']) !!}
        {!! Form::text('rg', null, ['class' => 'form-control mascara-rg', 'minlength' => '12']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-right-0">
        {!! Form::label('cpf', 'CPF', ['class' => 'control-label']) !!}
        {!! Form::text('cpf', null, ['class' => 'form-control mascara-cpf', 'minlength' => '14','required']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-right-0">
        {!! Form::label('data_nascimento', 'Data de Nascimento', ['class' => 'control-label']) !!}
        {!! Form::text('data_nascimento', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

	<div class="control-group form-group col-lg-3 padding-right-0">
		{!! Form::label('sexo', 'Sexo:', ['class' => 'control-label']) !!}
		{!! Form::select('sexo', $sexos, isset($funcionario) ? $funcionario->formSexoAttribute() : null, ['placeholder' => 'Selecione o sexo', 'class' => 'form-control']) !!}
	</div>


    <div class="control-group form-group">
        {!! Form::label('email', 'E-Mail', ['class' => 'control-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="control-group form-group">
        {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
        {!! Form::text('endereco', null, ['class' => 'form-control', 'required']) !!}
    </div>

	<div class="form-group">
		{!! Form::label('cargos', 'Cargos disponíveis', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-left-0']) !!}
		{!! Form::label('cargos', 'Cargos selecionados', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-right-0', 'style' => 'padding-left: 5%;']) !!}
		{!! Form::select('cargos[]', $cargos, @$cargosFuncionario, 
		['id' => 'cargos-multiselect', 'class' => 'form-control', 'multiple']) !!}
	</div>

    <div class="control-group form-group col-lg-6 padding-left-0">
        {!! Form::label('prontuario', 'Prontuário', ['class' => 'control-label']) !!}
        {!! Form::text('prontuario', null, ['class' => 'form-control prontuario', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-6 padding-right-0">
        {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="row">
        <div class="control-group form-group col-lg-6 telefones">
            {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
            {!! Form::text('telefone[0]', @$telefones[0], ['class' => 'form-control mascara-telefone', 'required']) !!}
        </div>
        <div class="control-group form-group col-lg-6 telefones">
            {!! Form::label('telefone', 'Telefone Alternativo', ['class' => 'control-label']) !!}
            {!! Form::text('telefone[1]', @$telefones[1], ['class' => 'form-control mascara-telefone']) !!}
        </div>
    </div>

    <button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    <a class="btn btn-danger right cancelar" href="{{ route('funcionarios') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
<script>
	$('#cargos-multiselect').multiSelect();
</script>
@endsection
