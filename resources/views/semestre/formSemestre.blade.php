@extends('layout.principal')

@section('title', 'Semestre')

@section('content')
@parent

<div class="">
    @if(isset($semestre))
    {!! Form::model($semestre, ['route'=>['semestre.atualizar', $semestre->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['route' => 'semestre.salvar', 'method' => 'post']) !!}
    @endif

    <div class="control-group form-group">
        {!! Form::label('nome', 'Identificação', ['class' => 'control-label']) !!}
        {!! Form::text('nome', '', ['class' => 'form-control', 'required', 'maxlength' => '6', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-left-0">
        {!! Form::label('data_inicio', 'Data Início', ['class' => 'control-label']) !!}
        {!! Form::text('data_inicio', '', ['class' => 'form-control data', 'required', 'minlength' => '10']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-right-0">
        {!! Form::label('data_fim', 'Data Fim', ['class' => 'control-label']) !!}
        {!! Form::text('data_fim', '', ['class' => 'form-control data', 'required', 'minlength' => '10']) !!}
    </div>

    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>


    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.data').mask('00/00/0000');
        });
    </script>
@endsection