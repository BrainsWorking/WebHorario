@extends('layout.principal')

@section('title', 'Semestre')

@section('content')
@parent

<div class="row">
    @if(isset($semestre))
    {!! Form::model($semestre, ['route'=>['semestre.atualizar', $semestre->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['route' => 'semestre.salvar', 'method' => 'post']) !!}
    @endif

    <div class="control-group form-group">
        {!! Form::label('nome', 'Identificação', ['class' => 'control-label']) !!}
        {!! Form::text('nome', '', ['class' => 'form-control', 'required', 'maxlength' => '6', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6">
        {!! Form::label('data_inicio', 'Data Início', ['class' => 'control-label']) !!}
        {!! Form::text('data_inicio', '', ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6">
        {!! Form::label('data_fim', 'Data Fim', ['class' => 'control-label']) !!}
        {!! Form::text('data_fim', '', ['class' => 'form-control', 'required']) !!}
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

</div>

{!! Form::close() !!}

@endsection

@section('scripts')

@endsection