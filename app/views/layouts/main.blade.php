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
                <li>{{ HTML::link('/competitions','Eventos') }}</li>
                <li>{{ HTML::link('/users/students','Estudiantes') }}</li>
                <li>{{ HTML::link('/users/employees','Docentes') }}</li>
                @else
                <li>{{ HTML::link('users/logout','Logout') }}</li>
                @endif
            </ul>
           <img src="/images/LogoUSCristal.png" alt="Logo" style="float: left; width: 100px; padding-top: 5px;"/>
           <h3 class="text-muted"> {{HTML::link('/','Votacion Sotavento')}}</h3>
        </header>




        <div class="jumbotron">
         @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
         @endif

         {{ $content }}
        </div>


	</div><!-- /container -->
	</body>
</html>