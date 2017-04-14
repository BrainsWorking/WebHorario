@extends('layout.principal')

@section('title', 'Cargos')

@section('content')
@parent

<div class="">
    @if(isset($cargo))
    {!! Form::model($cargo, ['route'=>['cargo.atualizar', $cargo->id], 'method'=>'PUT']) !!}
    @else
    {!! Form::open(['method' => 'post', 'route' => 'cargo.salvar']) !!}
    @endif

    <div class="control-group form-group">
        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <button type="submit" class="btn btn-success right"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    <a class="btn btn-danger right cancelar" href="{{ route('cargos') }}"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>


    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
@endsection