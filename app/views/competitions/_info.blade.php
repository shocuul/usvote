<h3>{{$competition->name}}</h3>
<span class="label label-primary">Fecha de inicio: {{$competition->fecha_inicio}}</span>
<span class="label label-success">Fecha de termino: {{$competition->fecha_final}}</span>
<br/>
<div class="panel panel-primary" style="margin-top: 10px;">
    <div class="panel-heading">
        <h3 class="panel-title">Concursantes \\ {{count($competition->students)}} Alumnos inscritos</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Facultad</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>

            @forelse($competition->students as $student)
            <tr>
            <td><img src="{{$student->imagen}}" alt="{{$student->name}}" class="avatar"/></td>
            <td>{{ $student->user->firstname ." ". $student->user->lastname }}</td>
            <td>{{$student->edad}}</td>
            <td>{{$student->facultad}}</td>
            <td>{{$student->descripcion}}</td>
            <td>
            @if(($student->edad)=='')
            {{link_to_route('students.adddata','Agregar Datos',array($student->id,$competition->id),array('class'=>'btn btn-primary'))}}
            @else
            {{link_to_route('competition.editdata','Editar Datos',array($student->id,$competition->id),array('class'=>'btn btn-primary'))}}
            @endif
            {{link_to_route('competitions.deletestudent','Borrar Alumno',array($competition->id,$student->id),array('class'=>'btn btn-danger'))}}</td>
            </tr>
            @empty
            <tr><h3>No hay Estudiantes Agregados</h3></tr>
            @endforelse
        </table>
    </div>
</div>