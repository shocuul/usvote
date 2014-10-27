<h1>Concursos Sotavento</h1>
@forelse($competitions as $competition)
<div class="panel panel-default">
  <div class="panel-heading"><h4><span class="label label-info">Nombre del evento: {{$competition->name}}</span></h4> </div>
  <div class="panel-body">
  <div class="row" style="display: block;">

    @forelse($competition->students as $student)
        <div class="col-sm6 col-md-4">
        <div class="thumbnail">
            <img src="{{$student->imagen}}" alt="{{$student->imagen}}" style="height: 196px;"/>
            <div class="caption">
            <h3>{{$student->user->firstname ." ". $student->user->lastname}}
            <span class="label label-success">Votos: {{$student->pivot->votes}}</span></h3>
            <h4>Facultad: <span class="label label-primary"> {{$student->facultad}} </span></h4>
            <h4>Edad: <span class="label label-primary">{{$student->edad}}</span></h4>
            <p>{{$student->descripcion}}</p>
            <p></p>
            {{link_to_route('competitions.vote','Votar',array($student->id,$competition->id),array('class'=>'btn btn-primary',))}}
            </div>
        </div>
        </div>
    @empty
    <h3><span class="label label-warning">No hay estudiantes en este concurso.</span></h3>
    @endforelse
    </div>
  </div>
</div>
@empty
<h2>No hay concursos.</h2>
@endforelse