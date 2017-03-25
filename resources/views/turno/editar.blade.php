@extends('layouts.principal')

@section('titulo', 'Cadastro de Turno')


@section('conteudo')

{{-- {!! Form::open(['route' => 'turno.atualizar' , 'method' => 'get']) !!}   --}}

{!! Form::model($turno ,['route' => 'turno.atualizar' , 'method' => 'get']) !!} 


{!! Form::label($id) !!}
{!! Form::text('nome', $turno->nome , ['class' => ".teste"]) !!}

{!! Form::submit('Enviar') !!}

{!! Form::close() !!}

@endsection