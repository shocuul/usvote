<div class="panel panel-primary">
    <div class="panel-heading">
     <h3 class="panel-title">
         Estudiantes
     </h3>
    </div>
    <div class="panel-body">
     <table class="table table-striped">
        <tr>
        <th>Nombre</th>
        <th>Matricula</th>
        <th>Facultad</th>
        <th>Acciones</th>
        </tr>
        @forelse($students as $student)
        <tr>
        <td>{{ $student->user->firstname ." ". $student->user->lastname }}</td>
        <td>{{$student->matricula}}
        <td>{{$student->facultad }}</td>
        <td>{{ HTML::link('users/{$student->id}','Ver Alumno',array('class'=>'btn btn-primary btn-sm','disabled'=>'disabled')) }}
        {{ HTML::link('users/{$student->id}/edit','Editar Alumno',array('class'=>'btn btn-primary btn-sm','disabled'=>'disabled')) }}
        {{ HTML::link('users/{$student->id}','Eliminar Alumno',array('class'=>'btn btn-danger btn-sm','disabled'=>'disabled')) }}</td>
        </tr>

        @empty
        <span class="label label-warning">No Hay Estudiantes</span>

        @endforelse
     </table>
     <br/>
     {{ HTML::link('users/register','Agregar Alumno',['class'=>'btn btn-primary btn-sm']) }}
     <br/>
     {{$students->links();}}
    </div>
</div>