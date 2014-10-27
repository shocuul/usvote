<div class="panel panel-info">
  <div class="panel-heading"><h2>Informacion del {{$user_type}}</h2></div>
  <div class="panel-body">
    <h3>Nombre: {{$user->firstname . " " . $user->lastname }}</h3>
    <h3>Matricula: {{$user->matricula}}</h3>
    @if(is_null($user->student))
    <h3>Cargo: {{$user->employee->cargo}}</h3>
    @else
    <h3>Facultad: {{$user->student->facultad}}</h3>
    @endif
    {{ HTML::link('users/edit/'.$user->id,'Editar '.$user_type,array('class'=>'btn btn-primary btn-sm')) }}
    {{Form::open(array('method'=>'DELETE','route'=>array('users.delete',$user->id),'style'=>'display:inline-block;'))}}
    {{Form::submit('Borrar '.$user_type,array('class'=>'btn btn-danger'))}}
    {{Form::close()}}
  </div>
</div>
