{{Form::model($student, array('method'=>'PATCH','route'=>array('competition.updatedata',$student->id,$idCompetition),'files' => true))}}
<h3>Editar informacion del concurso.</h3>
{{Form::label('edad','Edad:')}}
{{Form::text('edad',null,array('class'=>'form-control'))}}
{{Form::label('descripcion','Descripcion;')}}
{{Form::textarea('descripcion',null,array('class'=>'form-control'))}}
{{Form::label('imagen','Reemplazar imagen: ')}}
{{Form::file('imagen')}}
{{ Form::submit('Actualizar',array('class'=>'btn btn-lg btn-primary btn-block'))}}
{{Form::close()}}