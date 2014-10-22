{{Form::open(array('route'=>'competitions.store','class'=>'form-signup'))}}
    <h2 class="form-signup-heading">Introdusca Nuevo Evento</h2>
    <ul>
        @foreach ($errors->all() as $error)
    	    <li class="error">{{$error}}</li>
    	@endforeach
    </ul>
    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nombre'))}}
    {{Form::label('fecha_inicio','Introduca la fecha de inicio:',null,array('class'=>'form-control'))}}
    {{Form::input('date','fecha_inicio',null,array('class'=>'form-control'))}}
    {{Form::label('fecha_final','Introduca la fecha de inicio:',null,array('class'=>'form-control'))}}
    {{Form::input('date','fecha_final',null,array('class'=>'form-control'))}}
    {{Form::submit('Crear nuevo evento',array('class'=>'btn'))}}

{{Form::close()}}
