@extends('layout.so_header')
@section('title', 'Login')
@section('content')
<div class="col-lg-6 col-lg-offset-3" style="margin-top: 100px">
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open(["method" => "post", "route" => "logar"]) !!}
            {{ csrf_field() }}
            <div class="control-group form-group">
                {!! Form::label('prontuario', 'Prontuário', ['class' => 'control-label']) !!}
                {!! Form::text('prontuario', null, ['class' => 'form-control', 'required', 'autofocus', 'tabindex' => 1]) !!}
            </div>

            <div class="control-group form-group">
                {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
                <a class="right control-label" href="#">Esqueceu sua senha?</a>
                <div class="input-group">
                    {!! Form::password('password', ['class' => 'form-control senha', 'required', 'tabindex' => 2]) !!}
                    <span class="input-group-addon" data-show="0" style="cursor: pointer">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </span>
                </div>
            </div>

            <button type="submit" tabindex='3' class="btn btn-success right" value='Entrar'><span class="glyphicon glyphicon-log-in"></span> Entrar</button>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
@endsection
