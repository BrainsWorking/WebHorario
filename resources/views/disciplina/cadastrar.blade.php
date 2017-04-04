@extends('layout.principal')

@section('title', 'Disciplina')

@section('content')
@parent

@if(isset($sucesso))
<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-thumbs-up"></span> Sucesso!</strong> Cadastro realizado.
</div>
@elseif(isset($erro))
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><span class="glyphicon glyphicon-thumbs-down"></span> Erro!</strong> Ops, o seguinte erro ocorreu: {{$mensagem_erro}}.
</div>
@endif

@if(isset($disciplina))
{!! Form::model($disciplina, ['route'=>['disciplina.atualizar', $disciplina->id], 'method'=>'PUT']) !!}
@else
{!! Form::open(['route' => 'disciplina.salvar', 'method' => 'post']) !!}
@endif
<div class="row">
    <div class="disciplinas">
        <div class="control-group form-group col-sm-8">
            {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
            {!! Form::text('nome', '', ['class' => 'form-control', 'required']) !!}
        </div>

        <div class="control-group form-group col-sm-3">
            {!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
            {!! Form::text('sigla', '', ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
        </div>

        <div class="control-group col-sm-1">
            <button type="button" class="btn btn-success add-field">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

{!! Form::close() !!}

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/cadastro_disciplina.js') }}"></script>
@endsection