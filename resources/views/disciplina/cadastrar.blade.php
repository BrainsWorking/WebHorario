@extends('layout.principal')

@section('title', 'Disciplina')

@section('content')
    @parent

    @if(isset($disciplina))
        {!! Form::model($disciplina, ['route'=>['disciplina.atualizar', $disciplina->id], 'method'=>'PUT']) !!}
    @else
        {!! Form::open(['route' => 'disciplina.salvar', 'method' => 'post']) !!}
        <div class="control-group">
            <button type="button" class="btn btn-success add-field">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
            </button>
        </div>
    @endif

    <div class="row">
        <div>
            <div class="disciplinas">
                <div class="control-group form-group col-sm-6">
                    {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
                    {!! Form::text('nome[]', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="control-group form-group col-sm-3">
                    {!! Form::label('iniciais', 'Sigla', ['class' => 'control-label']) !!}
                    {!! Form::text('iniciais[]', null, ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
                </div>
                <div class="control-group form-group col-sm-2">
                    {!! Form::label('nome', 'Aulas/semana', ['class' => 'control-label']) !!}
                    {!! Form::text('cargaHoraria[]', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span>
        Salvar
    </button>

    {!! Form::close() !!}

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/cadastro_disciplina.js') }}"></script>
@endsection