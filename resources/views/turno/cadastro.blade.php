@extends('layouts.principal')

@section('titulo', 'Cadastro de Turno')


@section('conteudo')

{{-- {!! Form::open(['route' => 'turno.salvar' , 'method' => 'get']) !!}   --}}

{!! Form::model($cursos ,['route' => 'turno.salvar' , 'method' => 'get']) !!} 


{!! Form::label('nome') !!}
{!! Form::text('nome', $cursos->nome , ['class' => ".teste"]) !!}

{!! Form::submit('Enviar') !!}

{!! Form::close() !!}

@endsection