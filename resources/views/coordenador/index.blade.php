@extends('layout.principal')

@section('title', 'Coordenadores')

@section('content')
    @parent

    <div class="col-lg-12 table-responsive">
        <table class="table table-condensed table-hover">
            <thead>

            @include('layout.barra_superior_index', ["route" => "coordenador.cadastrar"])

            <th class="text-center">Curso</th>
            <th class="text-center">Coordenador</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Remover</th>
            </thead>


            <tbody>

            @forelse ($cursos as $curso)
                @if($curso->funcionario->isNotEmpty())
                <tr class="table-line">
                    <td class="text-center search">{{ $curso->nome }}</td>
                    <td class="text-center search">{{ $curso->funcionario->first()->nome }}</td>
                    <td class="text-center"><a href="{{ route('coordenador.editar', $curso->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td class="text-center"><a href="{{ route('coordenador.deletar', $curso->id) }}" class="table-delete confirmar"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                @endif
            @empty
                <tr class="text-center">
                    <td colspan="5"><h4>Não há coordenadores cadastrados</h4></td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/table.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/confirmar-delete.js') }}"></script>
@endsection