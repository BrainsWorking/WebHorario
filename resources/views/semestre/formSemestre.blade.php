@extends('layout.principal')

@section('title', 'Semestre')

@section('content')
@parent

<div class="">
    @if(isset($semestre))
    {!! Form::model($semestre, ['route'=>['semestre.atualizar', $semestre->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post', 'route' => 'semestre.salvar']) !!}
    @endif

    <div class="control-group form-group">
        {!! Form::label('nome', 'Identificação', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required', 'maxlength' => '6', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-left-0">
        {!! Form::label('inicio', 'Data Início', ['class' => 'control-label']) !!}
        {!! Form::date('inicio', null, ['class' => 'form-control data', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-right-0">
        {!! Form::label('fim', 'Data Fim', ['class' => 'control-label']) !!}
        {!! Form::date('fim', null, ['class' => 'form-control data', 'required']) !!}
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection
