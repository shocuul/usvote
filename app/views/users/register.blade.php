{{ Form::open(array('url'=>'users/create','class'=>'form-signup'))}}
	<h2 class="form-signup-heading">Introdusca Nuevo Usuario</h2>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{$error}}</li> 
		@endforeach
	</ul>
	{{ Form::text('firstname',null,array('class'=>'form-control','placeholder'=>'Nombre')) }}
	{{ Form::text('lastname',null,array('class'=>'form-control','placeholder'=>'Apellido')) }}
	{{ Form::text('email',null,array('class'=>'form-control','placeholder'=>'Correo Electronico')) }}
	{{ Form::password('password',array('class'=>'form-control','placeholder'=>'Contraseña')) }}
	{{ Form::password('password_confirmation',array('class'=>'form-control','placeholder'=>'Confirmar Contraseña')) }}
    {{ Form::select('type',array('none'=>'Seleccione el tipo de usuario','student'=>'Estudiante','employee'=>'Docente')) }}
    {{ Form::text('matricula',null,array('class'=>'form-control','placeholder'=>'Matricula')) }}
    {{ Form::text('type_description',null,array('class'=>'form-control','placeholder'=>'Ingrese la Facultad o el Cargo')) }}


	{{ Form::submit('Registrar',array('class'=>'btn btn-lg btn-primary btn-block'))}}

{{ Form::close() }}
