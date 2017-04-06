@extends('layout.principal')

@section('title', 'Turnos')

@section('content')
    @parent

    <div class="table-responsive">
        <table class="table table-condensed table-hover">
            <thead>

            <div class="padding-right-0 padding-left-0 top-bar">
                <div class="col-sm-8 padding-left-0">
                    <div class="input-group col-lg-12">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <input type="text" class="form-control input-filter" placeholder="Pesquisar">
                    </div>
                </div>

                <div class="col-sm-4 padding-right-0">
                    <a class="btn btn-success right col-sm-12" href="{{ route('turno.formTurno') }}"><span
                                class="glyphicon glyphicon-plus"></span> Cadastrar</a>
                </div>
            </div>

            <th class="text-center"></th>
            <th class="text-center">Turno</th>
            <th class="text-center">Quantidade de Aulas</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Remover</th>
            </thead>


            <tbody>

            @forelse ($turnos as $turno)
                <tr class="table-line">
                    <td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
                    <td class="text-center search"> {{$turno->nome}} </td>
                    <td class="text-center search"> {{$turno->quantidade_aulas}} </td>
                    <td class="text-center"><a href="{{ route('turno.editar', $turno->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td class="text-center"><a href="{{ route('turno.deletar', $turno->id) }}" class="table-delete"><span
                                    class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                <tr class="hidden-info">
                    <td colspan="5">
                        <div class="hidden-info-content">
                            <p><b>Nome do Turno:</b> {{$turno->nome}}</p>
                            <p><b>Quantidade de Aulas:</b> {{$turno->quantidadeAulas}}</p>
                            <p><b>Horarios: </b></p>
                            @foreach($turno->horarios as $horario)
						        <span class="col-lg-3 text-center">{{ $horario->inicio .' - '. $horario->fim }}</span>
						    @endforeach                            
                        </div>
                    </td>
                </tr>

            @empty
                <tr class="text-center">
                    <td colspan="5"><h4>Não há turnos cadastrados</h4></td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
@endsection