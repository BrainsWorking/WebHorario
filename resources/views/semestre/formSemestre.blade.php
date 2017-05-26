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

    {{--<div class="form-group">
        <label class="control-label">SELECIONE AS DISCIPLINAS QUE SERÃO OFERECIDAS NO SEMESTRE</label> 
        <a href="#" data-toggle="tooltip" data-placement='right' title="Caso a disciplina desejada não esteja listada, verifique se a mesma está cadastrada no menu 'Disciplinas' e se está vinculada a um curso, no menu 'Cursos'. "><span class="glyphicon glyphicon-info-sign"></span></a>
    </div>

    <div class="form-group">
        {!! Form::label('disciplinas', 'Disciplinas cadastradas', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-left-0']) !!}
        {!! Form::label('disciplinas', 'Disciplinas selecionadas', ['class' => 'control-label col-xs-6 col-sm- 6 col-md-6 col-lg-6 padding-right-0', 'style' => 'padding-left: 5%;']) !!}
        {!! Form::select('disciplina_id[]', $disciplinas, $disciplina_id, 
        ['id' => 'disciplina_id', 'class' => 'form-control', 'multiple']) !!}
    </div>--}}

    <button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    <a class="btn btn-danger right cancelar" href="{{ route('semestres') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script>
        $('#disciplina_id').multiSelect();
    </script>
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
@endsection