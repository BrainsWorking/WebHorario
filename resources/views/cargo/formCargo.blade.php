@extends('layout.principal')

@section('title', 'Cargos')

@section('content')
@parent

<div class="">
    @if(isset($cargo))
    {!! Form::model($cargo, ['route'=>['cargo.atualizar', $cargo->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post']) !!}
    @endif

    <div class="control-group form-group">
        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection
