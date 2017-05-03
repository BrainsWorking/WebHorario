@extends('layout.principal')

@section('title', 'Disciplinas')

@section('content')
@parent

<div class="col-lg-12 table-responsive">
    <table class="table table-condensed table-hover">
        <thead>

            @include('layout.components.barra_pesquisar_cadastrar', ["route" => "disciplina.cadastrar"])

            <th class="text-center"></th>
            <th class="text-center">Nome</th>
            <th class="text-center">Sigla</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Remover</th>
        </thead>
        <tbody>

            @forelse ($disciplinas as $disciplina)
            <tr class="table-line">
                <td class="text-center table-more-info"><span class="glyphicon glyphicon-chevron-down"></span></td>
                <td class="text-center search">
                   {{$disciplina->nome}} 
                   @if(empty($disciplina->cursos[0]))
                   <a style="color: #f0ad4e" href="#" data-toggle="tooltip" data-placement='right' title="Esta disciplina não está vinculada a nenhum curso, e isto a impede de ser cadastrada no semestre e FPA. Utilize o menu 'Cursos' para cadastra-la em seu respectivo curso."><span class="glyphicon glyphicon-alert"></span></a>
                   @endif
               </td>
               <td class="text-center search"> {{$disciplina->iniciais}} </td>
               <td class="text-center"><a href="{{ route('disciplina.editar', $disciplina->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
               <td class="text-center"><a href="{{ route('disciplina.deletar', $disciplina->id) }}" class="table-delete confirmar"><span class="glyphicon glyphicon-remove"></span></a></td>
           </tr>
           <tr class="hidden-info">
            <td colspan="5">
                <div class="hidden-info-content">
                    <p><b>Nome da Disciplina:</b> {{$disciplina->nome}}</p>
                    <p><b>Sigla:</b> {{$disciplina->sigla}}</p>
                    <p><b>Aulas/Semana:</b> {{$disciplina->aulasSemanais}}</p>
                    @if(!empty($disciplina->cursos[0]))
                      <p><b>Curso:</b> {{$disciplina->cursos[0]->nome}}</p>
                    @endif
                </div>
            </td>
        </tr>

        @empty
        <tr class="text-center">
            <td colspan="5"><h4>Não há disciplinas cadastradas</h4></td>
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
