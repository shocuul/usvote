
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            Concursos
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
        <tr>
        <th>Nombre</th>
        <th>Acciones</th>
        </tr>
        @forelse($competitions as $competition)
        <tr>
        <td>{{$competition->name }}</td>
        <td>
        {{link_to_route('competitions.show','Mostrar Evento',array($competition->id),array('class'=>'btn btn-info'))}}
        {{link_to_route('competitions.edit','Editar Evento',array($competition->id),array('class'=>'btn btn-info'))}}
        {{Form::open(array('method'=>'DELETE','route'=>array('competitions.destroy',$competition->id),'style'=>'display:inline-block;'))}}
        {{Form::submit('Borrar Evento',array('class'=>'btn btn-danger'))}}
        {{Form::close()}}
        </td>
        </tr>
         @empty
            <tr>
            <span class="label label-warning">No hay concursos.</span>
            </tr>


         @endforelse
        </table>
        {{link_to_route('competitions.create','Añadir nuevo evento',null,array('class'=>'btn btn-primary')) }}
    </div>
</div>