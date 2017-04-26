@extends('layout.principal')
@section('title', 'Instituição')
@section('content')

<h1>FPA</h1>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Abertura da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpaInicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-6 form-group padding-left-0">
    {!! Form::label('', 'Fechamento da FPA', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fpaFim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Semestre', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->nome, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Inicio', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->inicio, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Data de Fim', ['class' => 'control-label']) !!}
    {!! Form::text('', $semestre->fim, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('docente', 'Docente', ['class' => 'control-label']) !!}
    {!! Form::text('nome', $funcionario->nome, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', $funcionario->email, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('prontuario', 'Prontuario', ['class' => 'control-label']) !!}
    {!! Form::text('prontuario', $funcionario->prontuario, ['class' => 'form-control', 'required' , 'disabled']) !!}
</div>

<div class="col-lg-12 form-group padding-left-0">
    {!! Form::label('telefones', 'Telefones', ['class' => 'control-label']) !!}
</div>
@foreach($funcionario->telefones as $telefone)
    <div class="col-lg-12 form-group padding-left-0">
        {!! Form::text('telefone', $telefone->numero, ['class' => 'form-control', 'required' , 'disabled']) !!}
    </div>
@endforeach


<div class="col-lg-12 form-group padding-left-0">
    {!! Form::label('', 'SELECIONE AS DISCIPLINAS QUE DESEJA LECIONAR', ['class' => 'control-label']) !!}
    <a href="#" data-toggle="tooltip" data-placement='right' title="Para selecionar uma disciplina basta clicar em um campo em que exista uma seta apontando para baixo.">
        <span class="glyphicon glyphicon-info-sign"></span>
    </a>
</div>

<table class='table table-bordered table-hover'>
<thead>
    <tr>
        <th>Turno</th>
        <th>Horário</th>
        @foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] as $semana)
            <th>{{ $semana }}</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach($horarios_manha as $horario)
        <tr>

            @if($loop->first)
                <th rowspan="{{count($horarios_manha)}}" class="turno rotate-90"><span>Manhã</span></th>
            @endif

            <td>{{$horario->inicio}} às {{$horario->fim}}</td>

            @foreach($dias_semana as $semana)
                <td class='td-disciplina'>
                    <select class="chosen-select disciplina-fpa" data-placeholder=" " data-horario="{{$horario->id}}" data-semana="{{$semana}}" onclick="alterarAula($(this))">
                        <option value=''></option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                        @endforeach
                    </select>
                </td>
            @endforeach
        </tr>
    @endforeach

    @foreach($horarios_tarde as $horario)
        <tr>

            @if($loop->first)
                <th rowspan="{{count($horarios_tarde)}}" class="turno rotate-90"><span>Tarde</span></th>
            @endif

            <td>{{$horario->inicio}} às {{$horario->fim}}</td>

            @foreach($dias_semana as $semana)
                <td class='td-disciplina'>
                    <select class="chosen-select disciplina-fpa" data-placeholder=" " data-horario="{{$horario->id}}" data-semana="{{$semana}}" onclick="alterarAula($(this))">
                        <option value=''></option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                        @endforeach
                    </select>
                </td>
            @endforeach
        </tr>
    @endforeach

    
    @foreach($horarios_noite as $horario)
        <tr>

            @if($loop->first)
                <th rowspan="{{count($horarios_noite)}}" class="turno rotate-90"><span>Noite</span></th>
            @endif

            <td>{{$horario->inicio}} às {{$horario->fim}}</td>

            @foreach($dias_semana as $semana)
                <td class='td-disciplina'>
                    <select class="chosen-select disciplina-fpa" data-placeholder=" " data-horario="{{$horario->id}}" data-semana="{{$semana}}" onclick="alterarAula($(this))">
                        <option value=''></option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                        @endforeach
                    </select>
                </td>
            @endforeach
        </tr>
    @endforeach
</tbody>
</table>

@section('css')
    <link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
    <style>
        .td-disciplina{ padding: 0px !important; }
        .chosen-single{ height: 38px !important; line-height: 19px !important; margin-bottom: -2px}
        .chosen-single > span{ padding: 8px !important; }
        .chosen-container-single .chosen-single div { top: 5px; height: 22px; }
        .chosen-container-single .chosen-single abbr { top: 11px; }
        .rotate-90 { vertical-align: middle !important; text-align: center }
        .rotate-90 span{ display:block; transform: rotate(-90deg) }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/fpa-ajax.js')}}"></script>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Nenhuma disciplina encontrada!",
            width: '100%',
            allow_single_deselect: true 
        }); 
    </script>
@endsection
@endsection