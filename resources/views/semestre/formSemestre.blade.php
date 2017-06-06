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
        {!! Form::text('inicio', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-right-0">
        {!! Form::label('fim', 'Data Fim', ['class' => 'control-label']) !!}
        {!! Form::text('fim', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-left-0">
        {!! Form::label('inicio', 'Data de abertura do FPA', ['class' => 'control-label']) !!}
        {!! Form::text('fpa_inicio', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

    <div class="control-group form-group col-sm-6 padding-right-0">
        {!! Form::label('fim', 'Data de fechamento do FPA', ['class' => 'control-label']) !!}
        {!! Form::text('fpa_fim', null, ['class' => 'form-control mascara-data', 'required']) !!}
    </div>

    <div class="form-group">
        <label class="control-label">SELECIONE OS MÓDULOS QUE SERÃO OFERECIDOS NO SEMESTRE</label> 
        <a href="#" data-toggle="tooltip" data-placement='right' title="Caso o módulo desejado não esteja listado, verifique se o mesmo está cadastrado no menu 'Disciplinas'. "><span class="glyphicon glyphicon-info-sign"></span></a>
    </div>

    <div class="form-group">
        {!! Form::label('modulos', 'Módulos cadastrados', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-left-0']) !!}
        {!! Form::label('modulos', 'Módulos selecionados', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-right-0', 'style' => 'padding-left: 5%;']) !!}
        {!! Form::select('modulo_id[]', $modulos, $modulo_id, 
        ['id' => 'modulo_id', 'class' => 'form-control', 'multiple']) !!}
    </div>

    <button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    <a class="btn btn-danger right cancelar" href="{{ route('semestres') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script>
        $('#modulo_id').multiSelect({ selectableOptgroup: true });
    </script>
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
@endsection