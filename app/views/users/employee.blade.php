<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Profesores
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
        <tr>
        <th>Nombre</th>
        <th>Matricula</th>
        <th>Cargo</th>
        <th>Acciones</th>
        </tr>
        @forelse($employees as $employee)
        <tr>
        <td>{{$employee->user->firstname . " ". $employee->user->lastname}}</td>
        <td>{{$employee->user->matricula}}</td>
        <td>{{$employee->cargo}}</td>
        <td>
        {{ HTML::link('users/mostrar/'.$employee->user->id,'Ver Docente',array('class'=>'btn btn-primary btn-sm')) }}
        {{ HTML::link('users/edit/'.$employee->user->id,'Editar Docente',array('class'=>'btn btn-primary btn-sm')) }}
        {{Form::open(array('method'=>'DELETE','route'=>array('users.delete',$employee->user->id),'style'=>'display:inline-block;'))}}
        {{Form::submit('Borrar Docente',array('class'=>'btn btn-danger'))}}
        {{Form::close()}}
        </td>
        </tr>

        @empty
        <span class="label label-warning">No Hay Docentes</span>

        @endforelse
        </table>
        <br/>
        {{ HTML::link('users/register','Agregar Alumno',['class'=>'btn btn-primary btn-sm']) }}
        <br/>
         {{$employees->links();}}
    </div>
</div>