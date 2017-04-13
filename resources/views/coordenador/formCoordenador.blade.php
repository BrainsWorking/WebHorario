@extends('layout.principal')

@section('title', 'Coordenadores')

@section('content')
@parent

    @if(isset($curso))
    {!! Form::model($curso, ['route'=>['coordenador.atualizar', $curso->id], 'method'=>'PUT']) !!}
        <div class="control-group form-group col-lg-6">
            {!! Form::label('curso', 'Curso', ['class' => 'control-label']) !!}
            {!! Form::text('nome', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
        </div>
    @else
        {!! Form::open(['route' => 'coordenador.salvar', 'method' => 'post']) !!}

        <div class="control-group form-group col-lg-6">
            {!! Form::label('curso', 'Curso', ['class' => 'control-label']) !!}
            {!! Form::select('curso', $cursos, null, ['placeholder' => 'Escolha um curso', 'required', 'id' => 'curso_id', 'class' => 'form-control']) !!}
        </div>
    @endif

    <div class="control-group form-group col-lg-6">
        {!! Form::label('coordenador', 'Coordenador', ['class' => 'control-label']) !!}
        {!! Form::select('coordenador', $funcionarios, null, ['placeholder' => 'Escolha um funcionário', 'required', 'id' => 'funcionario_id', 'class' => 'form-control']) !!}
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

    {!! Form::close() !!}
@endsection
