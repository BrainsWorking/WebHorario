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
    {!! Form::label('', 'Semestre de Referência', ['class' => 'control-label']) !!}
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

{!! Form::open(['method' => 'post', 'route' => 'fpa.salvar']) !!}


<div class="col-lg-4 form-group padding-left-0">
    {!! Form::label('', 'Regime de Trabalho', ['class' => 'control-label']) !!} <br />
    {!! Form::label('', '20 Horas', ['class' => 'control-label']) !!}
    {!! Form::radio('regimeTrabalho', '20', ['class' => 'form-control', 'required']) !!} <br />
    {!! Form::label('', '40 Horas', ['class' => 'control-label']) !!}
    {!! Form::radio('regimeTrabalho', '40', ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-lg-12 form-group padding-left-0">
    {!! Form::label('', 'SELECIONE OS HORÁRIOS EM QUE DESEJA LECIONAR', ['class' => 'control-label']) !!}
    <a href="#" data-toggle="tooltip" data-placement='right' 
        title="Para selecionar um horário basta clicar nos retangulos abaixo.">
        <span class="glyphicon glyphicon-info-sign"></span>
    </a>
</div>

<table class='table table-bordered'>
<thead>
    <tr>
        <th class="text-center">Turno</th>
        <th class="text-center">Horário</th>
        @foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] as $semana)
            <th class="text-center">{{ $semana }}</th>
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
                <td class='td-disciplina none-padding'>
                    {!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
                    ['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
                    <label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
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
                <td class='td-disciplina none-padding'>
                    {!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
                    ['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
                    <label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
                </td>
            @endforeach
        </tr>
    @endforeach

    
    @foreach($horarios_noite as $horario)
        <tr>

            @if($loop->first)
                <th rowspan="{{count($horarios_noite)}}" class="turno rotate-90"><span>Noite</span></th>
            @endif

            <td> {{$horario->inicio}} às {{$horario->fim}}</td>

            @foreach($dias_semana as $semana)
                <td class='td-disciplina none-padding'>
                    {!! Form::checkbox("disp[$semana][]", "$horario->id", false, 
                    ['class' => 'fpa-checkbox', 'id' => "{$horario->id}-{$semana}"]) !!}
                    <label class="label-check" for="{{$horario->id}}-{{$semana}}"> </label>
                </td>
            @endforeach
        </tr>
    @endforeach
</tbody>
</table>

<div class="control-group">
    <button type="button" class="btn btn-success add-field">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        Adicionar Disciplina
    </button>
</div>

<div class="escolha-disciplinas col-lg-12">
    <div class="row">
        <div class="col-lg-2">
            <label class="index">Disciplina 1</label>
        </div>
        <div class="form-group col-lg-4">
            <select class="chosen-select" data-placeholder=" ">
                <option value=''></option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                @endforeach
                <!--optgroup label="ADS">
                </optgroup -->
            </select>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success right">
    <span class="glyphicon glyphicon-floppy-disk"></span>
    Salvar
</button>

{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/fpa-disciplinas.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Nenhuma disciplina encontrada!",
            width: '100%',
            allow_single_deselect: true 
        });

        $(document).ready(function(){
                'use strict'
            	var wrapper = $(".escolha-disciplinas");
                var button = $(".add-field");
                var x = $('.index').length + 1;

                $(button).click(function(e){
                    e.preventDefault();
                    $(wrapper).append(`
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="index">Disciplina ` + x + `</label>
                            </div>
                            <div class="form-group col-lg-4">
                                <select class="chosen-select" data-placeholder=" ">
                                    <option value=''></option>
                                    @foreach($disciplinas as $disciplina)
                                        <option value="{{$disciplina['id']}}">{{$disciplina['nome']}}</option>
                                    @endforeach
                                    <!--optgroup label="ADS">
                                    </optgroup -->
                                </select>
                            </div>
                            <div class="col-lg-1 padding-right-0 remove-field">
                                <button type="button" class="btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
                    `);

                    $(".chosen-select").chosen({
                        no_results_text: "Nenhuma disciplina encontrada!",
                        width: '100%',
                        allow_single_deselect: true 
                    });
                    x++;
                });

                $(wrapper).on("click", ".remove-field", function(e){
                    e.preventDefault();
                    $(this).parent().remove();

                    var labels = $('.index');
                    for (var i = 0; i <= x; i++) {
                        $(labels[i]).html("Disciplina " + (i + 1));
                    };
                    x--;
                });
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/chosen/chosen.css')}}">
    <style>
        .none-padding{
            padding: 0 !important;
        }
        .td-disciplina{
            cursor: pointer;
            padding: 0px !important; 
            text-align: center !important;
            vertical-align: middle !important;    
        }
        .label-check{
            cursor: pointer;
            display: inline;
            font-size: 25px;
        }
        .fpa-checkbox{
            display: none;
        }
        .fpa-checkbox + .label-check{
            text-align: center;
            width: 100%;
            min-width: 32px;
            display: inline-block;
            margin: 0;
        }
        .fpa-checkbox + .label-check:after{
            width: 100%;
            content: ' ';
            display: inline-block;
        }
        .fpa-checkbox:checked + .label-check:after{
            content: "✓";
            color:#43a047;
        }
        .rotate-90 { vertical-align: middle !important; text-align: center }
        .rotate-90 span{ display:block; transform: rotate(-90deg) }
        .escolha-disciplinas{ margin-top: 15px !important; }
    </style>
@endsection
@endsection