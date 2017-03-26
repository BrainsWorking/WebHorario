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
</head>

<body class="col-lg-12">

	<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>

	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

		<header class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
				<a href=""><img class="img-responsive" src="{{ asset('/img/ifsp_logo_2.png') }}"></a>
			</div>
			<div class="right col-xs-6 col-sm-4 col-md-3 col-lg-3">
				<p class="right"><a href="">Sair <span class="glyphicon glyphicon-off"></span></a></p>

				<!-- INSERIR NOME DA SESSÃO DO USUARIO -->
				<p>Olá, Fulano</p>

			</div>
		</header>

		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar">
			<ul class="nav nav-pills nav-stacked">

				<li><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<li class=" sidebar-active"><a href="/turnos"><span class="glyphicon glyphicon-time"></span> Turnos</a></li>
				<li><a href="/disciplinas"><span class="glyphicon glyphicon-book"></span> Disciplinas</a></li>
				<li><a href="/cursos"><span class="glyphicon glyphicon-education"></span> Cursos</a></li>
				<li><a href=""><span class="glyphicon glyphicon-user"></span> Editar Perfil</a></li>

			</ul>
		</div>

		<!-- ADICIONAR CONTEUDO DA PAGINA AQUI -->
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 content">
			@yield('content')
		</div>

		<footer class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<hr>
			<p class="text-center">IFSP - Instituto Federal de Educação, Ciência e Tecnologia de São Paulo Campus Caraguatatuba</p>
			<p class="text-center">Avenida Bahia, 1739 - Indaiá - Caraguatatuba SP - CEP: 11665-071 - Telefone: 55 (12) 3885-2130</p>
			<p class="text-center">Desenvolvimento: ACME - Brains Working</p>
		</footer>
	</div>

	<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
	@yield('scripts')

</body>

</html>