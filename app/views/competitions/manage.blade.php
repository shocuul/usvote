@include('competitions._info',compact('competition'))
{{link_to_route('competitions.show','Volver',array($competition->id),array('class'=>'btn btn-info'))}}
<h3>Agregar Estudiantes</h3>
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
        <td>{{$student->user->matricula}}
        <td>{{$student->facultad }}</td>
        <td>{{ link_to_route('competitions.addstudent','Añadir Alumno',array($competition->id,$student->id),array('class'=>'btn btn-info')) }}
        </td>
        </tr>

        @empty
        <span class="label label-warning">No Hay Estudiantes</span>

        @endforelse
     </table>
     <br/>
     <br/>
     {{$students->links();}}
    </div>
</div>