{{Form::model($user,array('method'=>'PATCH','url'=>'users/update/'.$user->id,'class'=>'form'))}}
<h3>Editar usuario</h3>
    {{Form::label('firstname','Nombre: ')}}
    {{Form::text('firstname',null,array('class'=>'form-control'))}}
    {{Form::label('lastname','Apellido: ')}}
    {{Form::text('lastname',null,array('class'=>'form-control'))}}
    {{Form::label('matricula','Matricula: ')}}
    {{Form::text('matricula',null,array('class'=>'form-control'))}}
    {{Form::label('email','Correo Electronico:')}}
    {{Form::text('email',null,array('class'=>'form-control'))}}
    {{Form::submit('Actualizar '.$user_type,array('class'=>'btn btn-info'))}}
    @if ($errors->any())
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
    @endif
{{Form::close()}}