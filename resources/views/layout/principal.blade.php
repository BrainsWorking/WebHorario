<!DOCTYPE html>
<html lang="pt-br">
@include('layout.components.head')

<body>
    <div class="container-fluid">
        @include('layout.components.header')
        <div class="row">
            <div class="text-right saudacao">
                <ul class="nav">
                    @if(Auth::check())
                    <li class="dropdown pull-right">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle usuario">
                            {{ Auth::user()->nome }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('funcionario.perfil') }}"}><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Meu perfil</a></li>
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
            <!-- ADICIONAR CONTEUDO DA PAGINA AQUI -->
           @include('layout.components.sidebar')
           <div class="col-lg-10 collapsed-canvas clearfix" id="content">
                <!-- Conteúdo -->
                @include('layout.components.alerts')
                @yield('content')
            </div>
        </div>
    </div>
    @include('layout.components.footer')
    <script type="text/javascript" src="{{ asset('/js/off-canvas.js') }}"></script>
</body>

</html>
