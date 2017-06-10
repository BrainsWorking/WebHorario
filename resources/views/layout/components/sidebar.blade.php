<div class="col-lg-2 sidebar collapsed-canvas hidden-print" id='sidebar'>
    <ul class="nav nav-pills nav-stacked">
        <li class="{{ setActive('home') }}">
            <a href="{{ route('home') }}">
                <span class="glyphicon glyphicon-home"></span> <span class='sidebar-label'>Home</span>
            </a>
        </li>
        <li class="{{ setActive('turno') }}">
            <a href="{{ route('turnos') }}">
                <span class="glyphicon glyphicon-time"></span> <span class='sidebar-label'>Turnos</span>
            </a>
        </li>
        {{-- <li class="{{ setActive('disciplina') }}">
            <a href="{{ route('disciplinas') }}">
                <span class="glyphicon glyphicon-book"></span> <span class='sidebar-label'>Disciplinas</span>
            </a>
        </li> --}}
        <li class="{{ setActive('curso') }}">
            <a href="{{ route('cursos') }}">
                <span class="glyphicon glyphicon-education"></span> <span class='sidebar-label'>Cursos</span>
            </a>
        </li>
        <li class="{{ setActive('semestre') }}">
            <a href="{{ route('semestres') }}">
                <span class="glyphicon glyphicon-calendar"></span> <span class='sidebar-label'>Semestres</span>
            </a>
        </li>            
        <li class="{{ setActive('funcionario') }}">
            <a href="{{ route('funcionarios') }}">
                <span class="glyphicon glyphicon-user"></span> <span class='sidebar-label'>Funcionários</span>
            </a>
        </li>
        <li class="{{ setActive('instituicao') }}">
            <a href="{{ route('instituicao') }}">
                <span class="glyphicon glyphicon-briefcase"></span> <span class='sidebar-label'>Instituição</span>
            </a>
        </li>
        @if(!is_null(\App\Models\Semestre::fpaAtivo()))
        <li class="{{ setActive('fpa') }}">
            <a href="{{ route('fpa') }}">
                <span class="glyphicon glyphicon-duplicate"></span> <span class='sidebar-label'>FPA</span>
            </a>
        </li>
        @endif
    </ul>
</div>