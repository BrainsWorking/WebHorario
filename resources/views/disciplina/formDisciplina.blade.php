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
                    {!! Form::label('sigla', 'Sigla', ['class' => 'control-label']) !!}
                    {!! Form::text('sigla[]', null, ['class' => 'form-control', 'required', 'maxlength' => '5', 'required']) !!}
                </div>
                <div class="control-group form-group col-sm-2">
                    {!! Form::label('aulas_semanais', 'Aulas/semana', ['class' => 'control-label']) !!}
                    {!! Form::text('aulas_semanais[]', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span>
        Salvar
    </button>
    <a class="btn btn-danger right cancelar" href="{{ route('disciplinas') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

    {!! Form::close() !!}

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/cadastro_disciplina.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
@endsection