{{Form::open(array('route'=>array('student.savedata',$idStudent,$idCompetition),'files' => true))}}
    <h2 class="form-signup-heading">Introdusca los datos adicionales.</h2>
    {{ Form::text('edad',null,array('class'=>'form-control','placeholder'=>'Edad')) }}
    {{Form::label('descripcion','Ingrese la descripcion:',array())}}
    {{Form::textarea('descripcion',null,array('class'=>'form-control'))}}
    {{Form::file('imagen')}}
    {{ Form::submit('Guardar',array('class'=>'btn btn-lg btn-primary btn-block'))}}
{{Form::close()}}