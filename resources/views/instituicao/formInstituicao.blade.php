@extends('layout.principal')

@section('title', 'Instituição')

@section('content')
@parent

@if(isset($instituicao))
{!! Form::model($instituicao, ['route'=>['instituicao.atualizar', $instituicao->id], 'method'=>'PUT']) !!}
@else
{!! Form::open(['method' => 'post', 'route' => 'instituicao.salvar']) !!}
@endif

<div class="">
    <div class="control-group form-group">
        {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="control-group form-group col-lg-8 padding-left-0">
        {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
        {!! Form::text('endereco', null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="control-group form-group col-lg-8 padding-left-0">
        {!! Form::label('cep', 'CEP', ['class' => 'control-label']) !!}
        {!! Form::text('cep', null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="control-group form-group col-lg-8 padding-left-0">
        {!! Form::label('telefone', 'Telefone', ['class' => 'control-label']) !!}
        {!! Form::text('telefone', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>
<button type="submit" class="btn btn-success btn-lg right"><span class="glyphicon glyphicon-floppy-disk"></span>
    Salvar
</button>

{!! Form::close() !!}

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.cnpj').mask('000.000.000/0000-00', {reverse : true});
    
});
</script>
@endsection