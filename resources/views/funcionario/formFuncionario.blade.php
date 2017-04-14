@extends('layout.principal')

@section('title', 'Pessoas')

@section('content')
@parent

<div class="">
    @if(isset($funcionario))
    {!! Form::model($funcionario, ['route'=>['funcionario.atualizar', $funcionario->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post', 'files' => true]) !!}
    @endif

    <div class="control-group form-group col-lg-8 padding-left-0">
        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-4 padding-right-0">
        {!! Form::label('foto', 'Foto', ['class' => 'control-label']) !!}
        {!! Form::file('foto', ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-left-0">
        {!! Form::label('rg', 'RG', ['class' => 'control-label']) !!}
        {!! Form::text('rg', null, ['class' => 'form-control rg', 'minlength' => '12','required']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-right-0">
        {!! Form::label('cpf', 'CPF', ['class' => 'control-label']) !!}
        {!! Form::text('cpf', null, ['class' => 'form-control cpf', 'minlength' => '14','required']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-right-0">
        {!! Form::label('data_nascimento', 'Data de Nascimento', ['class' => 'control-label']) !!}
        {!! Form::date('data_nascimento', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-3 padding-right-0">
        {!! Form::label('sexo', 'Sexo', ['class' => 'control-label']) !!}
        <select class="form-control" required>
            <option>Escolha um sexo</option>
            <option value='m'>Masculino</option>
            <option value='f'>Feminino</option>
        </select>
    </div> 

    <div class="control-group form-group">
        {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
        {!! Form::text('endereco', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('cargo', 'Cargo', ['class' => 'control-label']) !!}
        {!! Form::select('cargo_id', $cargos, null, ['placeholder' => 'Escolha um cargo', 'required', 'id' => 'cargo_id', 'class' => 'form-control']) !!}
    </div>

    <div class="control-group form-group col-lg-6 padding-left-0">
        {!! Form::label('login', 'Login (Prontuário)', ['class' => 'control-label']) !!}
        {!! Form::text('login', null, ['class' => 'form-control prontuario', 'required']) !!}
    </div>

    <div class="control-group form-group col-lg-6 padding-right-0">
        {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    {{-- <div class="control-group form-group padding-left-0 col-lg-3" style="margin-top: 14px;">
        <button type="button" class="btn btn-default add-field form-control">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outros telefones
        </button>
    </div>

    @if(isset($funcionario))
    <div class="control-group form-group padding-right-0 col-lg-9 telefones">
        {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
        @foreach($funcionario->telefone as $telefone)
        {!! Form::text('telefone[]', $telefone, ['class' => 'form-control telefone', 'required']) !!}
        @endforeach
    </div>
    @else
    <div class="control-group form-group padding-right-0 col-lg-9 telefones">
        {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
        {!! Form::text('telefone[]', null, ['class' => 'form-control telefone', 'required']) !!}
    </div>
    @endif --}}

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/cadastro_pessoa.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse : true});
    $('.rg').mask('00.000.000-0', {reverse : true});
    $('.telefone').mask('(00) 00000-0000');
});
</script>
@endsection
