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

    {{-- @foreach($cursos as $curso) --}}
    <div class="control-group form-group col-lg-6">
        {!! Form::label('nome', 'Curso', ['class' => 'control-label']) !!}
        {!! Form::text('nome', 'Analise e Desenvolvimento de Sistemas', ['class' => 'form-control', 'required', 'disabled']) !!}
    </div>

    <div class="control-group form-group col-lg-6">
        {!! Form::label('coordenador', 'Coordenador', ['class' => 'control-label']) !!}
        {{-- {!! Form::select('coordenador', $pessoas, null, ['placeholder' => 'Escolha um funcionário', 'required', 'id' => 'funcionário_id', 'class' => 'form-control']) !!} --}}
        <select class="form-control">
            <option>Escolha o professor coordenador</option>
            <option>Lucas Venezian Povoa</option>
        </select>
    </div>
    {{-- @endforeach --}}

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection
