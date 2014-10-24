<!DOCTYPE html>
<html lang="es">
	<head>
		<meta chatset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{HTML::style('packages/bootstrap/css/bootstrap.min.css')}}
		{{HTML::style('css/main.css')}}
		<title>Votacion Sotavento</title>
	</head>
	<body>
	<div class="container">

        <header>
            <ul class="nav nav-pills pull-right">
                @if(!Auth::check())
                <li>{{HTML::link('/users/login','Iniciar Sesion')}}</li>
                @else
                @if((!Auth::user()->admin)==0)
                <li>{{ HTML::link('/competitions','Eventos') }}</li>
                <li>{{ HTML::link('/users/students','Estudiantes') }}</li>
                <li>{{ HTML::link('/users/employees','Docentes') }}</li>
                @endif
                <li>{{ HTML::link('users/logout','Logout') }}</li>
                @endif
            </ul>
           <img src="/images/LogoUSCristal.png" alt="Logo" style="float: left; width: 100px; padding-top: 5px;"/>
           <h3 class="text-muted"> {{HTML::link('/','Votacion Sotavento')}}</h3>
        </header>




        <div class="jumbotron">
         @if(Session::has('message'))
         <div class="alert alert-success" role="alert">
         <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
         {{ Session::get('message') }}</div>
         @endif
        <script>
        $(".alert").alert();
        </script>
         {{ $content }}
        </div>


	</div><!-- /container -->
	{{ HTML::script('js/jquery-1.11.1.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>