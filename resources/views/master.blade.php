<!-- master.blade.php -->
<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('css/base.css')}}" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
		<script src="{{asset('js/base.js')}}" type="text/javascript"></script> 

        <title>A Web Page</title>

        <!-- Fonts -->

    </head>
    <body class="classBody">
        <div id= "containerGeral" class="container">
			<div id="divNavBar" >
				<ul id="nav-tabs" class="nav nav-tabs">
					<li><a href="{{action('CRUDController@create')}}">Cadastrar</a></li>
					<li id="liBusca"><a href="{{action('CRUDController@index')}}">Busca de Aluno</a></li>
					<li><a href="{{action('CRUDController@notas')}}">Notas (Média)</a></li>
				</ul>
			</div>
			
			@yield('content')

		</div>
    </body>
</html>