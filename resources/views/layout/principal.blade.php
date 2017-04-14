<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/off-canvas.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <title> @yield('title') - WebHorário</title>
    <link rel="icon" href="{{ asset('/img/webhorario.ico') }}" type="image/x-icon">
    @yield('css')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <header class="col-xs-12 col-sm-12">
                <div class="col-xs-6 col-sm-6">
                    <a href="{{ route('home') }}">
                        <img class="img-responsive webhorario-logo pull-left" src="{{ asset('/img/webhorario.png') }}">
                        <h1 class="hidden-xs">Webhorário</h1>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <a href="http://www.ifspcaraguatatuba.edu.br" target="_blank"><img class="img-responsive ifsp-logo pull-right" src="{{ asset('/img/ifsp.png') }}"></a>
                </div>
            </header>
        </div>
        <div class="row">
            <div class="text-right saudacao">
                <ul class="nav">
                    @if(Auth::user())
                    <li class="dropdown pull-right">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle usuario">
                            {{ Auth::user()->nome }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Meu perfil</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('deslogar') }}"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <div class="usuario">Convidado</div>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
        
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-2 sidebar collapsed-canvas" id='sidebar'>
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
                    <li class="{{ setActive('disciplina') }}">
                        <a href="{{ route('disciplinas') }}">
                            <span class="glyphicon glyphicon-book"></span> <span class='sidebar-label'>Disciplinas</span>
                        </a>
                    </li>
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
                    <li class="{{ setActive('cargo') }}">
                        <a href="{{ route('cargos') }}">
                            <span class="glyphicon glyphicon-apple"></span> <span class="sidebar-label">Cargos</span>
                        </a>
                    </li>                    
                    <li class="{{ setActive('funcionario') }}">
                        <a href="{{ route('funcionarios') }}">
                            <span class="glyphicon glyphicon-user"></span> <span class='sidebar-label'>Funcionários</span>
                        </a>
                    </li>
                    <li class="{{ setActive('coordenador') }}">
                        <a href="{{ route('coordenadores') }}">
                            <span class="glyphicon glyphicon-bullhorn"></span> <span class='sidebar-label'>Coordenadores</span>
                        </a>
                    </li>
                    <li class="{{ setActive('instituicao') }}">
                        <a href="{{ route('instituicao') }}">
                            <span class="glyphicon glyphicon-briefcase"></span> <span class='sidebar-label'>Instituição</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ADICIONAR CONTEUDO DA PAGINA AQUI -->
            <div class="col-sm-8 col-md-9 col-lg-10 collapsed-canvas" id="content">

                @include('layout.alerts')

                @yield('content')
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            @if(isset($dadosInst))
                <p>
                   
                    {{ $dadosInst->nome }}
                </p>
                <p>
                    {{ $dadosInst->endereco or 'Endereço da instituicao' }} - 
                    CEP: {{ $dadosInst->cep  or 'CEP da instituicao'}} - 
                    Telefone: +55 {{ $dadosInst->telefone or 'Telefone da instituicao' }}
                </p>
                <p class="text-center">
                    Desenvolvimento ACME & Brains Working
                </p>
            @else
                <a href="{{ route('instituicao') }}">Cadastrar Instituição</a>
            @endif
        </div>
    </footer>

    <script type="text/javascript" src="{{ asset('/js/jquery-3.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/off-canvas.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/footer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>

    @yield('scripts')
    <script>
        $('.mascara-data').mask('00/00/0000');
        $('.mascara-rg').mask('00.000.000-0');
        $('.mascara-cpf').mask('000.000.000-00');
        
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 0-0000-0000' : '(00) 0000-00009';
        }

        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('.mascara-telefone').mask(SPMaskBehavior, spOptions);
    </script>
</body>

</html>
