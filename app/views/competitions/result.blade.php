@forelse($competitions as $competition)
<div class="panel panel-default">
  <div class="panel-heading"><h4><span class="label label-info">Nombre del evento: {{$competition->name}}</span></h4> </div>
  <div class="panel-body">
  <div class="row">
  @forelse($competition->winner as $student)
  <div class="col-sm-6 col-md-4">
  <div class="thumbnail">
  <div class="caption">
  <h5> <span class="label label-primary">{{$lugares++}}º Lugar</span> </h5>
  <img src="{{$student->imagen}}" alt="Foto" style="width: 100%;"/>
  <h3>Nombre: <br/>{{$student->user->firstname ." ". $student->user->lastname}}</h3>
  <h4>Numero total de votos:</h4>
  <h4>{{$student->pivot->votes}}</h4>
  </div>
  </div>
  </div>
  @empty
  <h3>No hay Ganadores.</h3>
  @endforelse
  </div>
  </div>
</div>

@empty

@endforelse