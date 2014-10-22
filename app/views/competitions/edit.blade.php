
{{Form::model($competition, array('method'=>'PATCH','route'=>array('competitions.update',$competition->id),'class'=>'form-signup','role'=>'form'))}}
    <h3>Editar competencia.</h3>
    {{Form::label('name','Nombre del evento:')}}
    {{Form::text('name',null,array('class'=>'form-control'))}}
    {{Form::label('fecha_inicio','Introduca la fecha de inicio:',null,array('class'=>'form-control'))}}
    {{Form::input('date','fecha_inicio',null,array('class'=>'form-control'))}}
    {{Form::label('fecha_final','Introduca la fecha de inicio:',null,array('class'=>'form-control'))}}
    {{Form::input('date','fecha_final',null,array('class'=>'form-control'))}}
    {{Form::submit('Actualizar evento',array('class'=>'btn btn-info'))}}
    {{link_to_route('competitions.show','Cancelar',$competition->id,array('class'=>'btn btn-default'))}}
    @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    @endif
{{Form::close()}}