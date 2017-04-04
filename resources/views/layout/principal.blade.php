<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <title> @yield('title') - WebHorário</title>
    <link rel="icon" href="" type="image/x-icon">
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
            <p>
                Ola, Fulano
                <a href="#"><span class="glyphicon glyphicon-off"></span></a>
            </p>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4 col-md-3 col-lg-2 sidebar">

            <ul class="nav nav-pills nav-stacked">

                <li class="{{ setActive('home') }}"><a href="{{ route('home') }}"><span
                                class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="{{ setActive('turno') }}"><a href="{{ route('turnos') }}"><span
                                class="glyphicon glyphicon-time"></span> Turnos</a></li>
                <li class="{{ setActive('disciplina') }}"><a href="{{ route('disciplinas') }}"><span
                                class="glyphicon glyphicon-book"></span> Disciplinas</a></li>
                <li class="{{ setActive('curso') }}"><a href="{{ route('cursos') }}"><span
                                class="glyphicon glyphicon-education"></span> Cursos</a></li>
                <li class="{{ setActive('perfil.editar') }}"><a href=""><span class="glyphicon glyphicon-user"></span>
                        Editar Perfil</a></li>

            </ul>
        </div>

        <!-- ADICIONAR CONTEUDO DA PAGINA AQUI -->
        <div class="col-sm-8 col-md-9 col-lg-10 content">
            @yield('content')
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container">
    <p>IFSP - Instituto Federal de Educação, Ciência e Tecnologia de São Paulo Campus
        Caraguatatuba</p>
    <p>Avenida Bahia, 1739 - Indaiá - Caraguatatuba/SP - CEP: 11665-071 - Telefone: +55 (12)
        3885-2130</p>
    <p class="text-center">Desenvolvimento: ACME & Brains Working</p>
    </div>
</footer>


<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
@yield('scripts')

</body>

</html>
