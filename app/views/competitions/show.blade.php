 @include('competitions._info',compact('competition'))

 {{link_to_route('competitions.manage','Administrar',array($competition->id),array('class'=>'btn btn-warning'))}}