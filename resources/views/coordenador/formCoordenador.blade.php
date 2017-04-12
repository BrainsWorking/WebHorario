@extends('layout.principal')

@section('title', 'Coordenadores')

@section('content')
@parent

<div class="">
    @if(isset($cursos))
    {!! Form::model($cargo, ['route'=>['coordenadores.atualizar', $coordenador->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post']) !!}
    @endif

    <div class="control-group form-group col-lg-6">
        {!! Form::label('curso', 'Curso', ['class' => 'control-label']) !!}
        {{-- {!! Form::select('curso', $cursos, null, ['placeholder' => 'Escolha um curso', 'required', 'id' => 'curso_id', 'class' => 'form-control']) !!} --}}
        <select class="form-control">
            <option>Escolha o curso</option>
            <option>Analise e Desenvolvimento de Sistemas</option>
        </select>
    </div>

    <div class="control-group form-group col-lg-6">
        {!! Form::label('coordenador', 'Coordenador', ['class' => 'control-label']) !!}
        {{-- {!! Form::select('coordenador', $pessoas, null, ['placeholder' => 'Escolha um funcionário', 'required', 'id' => 'funcionário_id', 'class' => 'form-control']) !!} --}}
        <select class="form-control">
            <option>Escolha o professor coordenador</option>
            <option>Lucas Venezian Povoa</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection
