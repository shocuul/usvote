
<p></p>
<p></p>
<p></p>
<h1>Resultados</h1>
@foreach ($finalizado as $competition ) 
<div class="panel panel-success">
    <div class="panel-heading"><strong>Nombre del concurso:</strong> {{$competition->name}}</div>
    <div class="panel-body">
        <p class="text-center"><strong>Grafica de pastel</strong></p>   
        <div id="grafica-{{$competition->name}}" style="width:600px; height: 400px; margin: 8px auto;"></div>
        <br>
        <p class="text-center"><strong>Grafica de barras</strong></p>  
        <div id="barras-{{$competition->name}}" style="width:600px; height: 400px; margin: 8px auto;"></div> 
<script>

	(function basic_pie(container) {
    var
    // d1 = [
    //     [0, 18]
    // ],
    //     d2 = [
    //         [0, 10]
    //     ],
    //     d3 = [
    //         [0, 5]
    //     ],
        graph;
    var num = -1;
    @foreach ($competition->students as $student)
    @if($student)
    var d{{$jshelper}} = [[num, {{$student->pivot->votes}}]];
    var label{{$jshelper}} = '{{$student->user->firstname ." ". $student->user->lastname}}';
    {{$jshelper = $jshelper + 1}}
    num = num + 1;
    @endif
@endforeach
    console.log(num);
    graph = Flotr.draw(container, [{
        data: d1,
        label: label1
    }, {
        data: d2,
        label: label2
    }, {
        data: d3,
        label: label3,
    }], {
        HtmlText: false,
        grid: {
            verticalLines: false,
            horizontalLines: false
        },
        xaxis: {
            showLabels: false
        },
        yaxis: {
            showLabels: false
        },
        pie: {
            show: true,
            explode: 6
        },
        mouse: {
            track: false
        },
        legend: {
            position: 'ns',
            backgroundColor: '#D2E8FF'
        }
    });
})(document.getElementById("grafica-{{$competition->name}}"));
(function basic_bars(container, horizontal) {

    var
    horizontal = (horizontal ? true : false);
        // Show horizontal bars

      //   d1 = [],
      //   // First data series
      //   d2 = [],
      //   d3 = [],
      //   // Second data series
      //   point, // Data point variable declaration
      //   i;

      
      // point = [-1, 13];
      // d1.push(point);
  
      // point = [0,5];
      // d2.push(point);
   
  
      // point = [1,10];
      // d3.push(point);
    {{$jshelper = 1}}
    var num = -1;
    @foreach ($competition->students as $student)
    @if($student)
    var d{{$jshelper}} = [[num, {{$student->pivot->votes}}]];
    var label{{$jshelper}} = '{{$student->user->firstname ." ". $student->user->lastname}}';
    {{$jshelper = $jshelper + 1}}
    num = num + 1;    
    @endif
    @endforeach
    // Draw the graph
    Flotr.draw(
      container, [{data:d1,label: label1},{data:d2,label:label2},{data:d3,label:label3}], {
        bars: {
            show: true,
            horizontal: horizontal,
            shadowSize: 0,
            barWidth: 0.5
        },
      xaxis:{
        showLabels:false
      },
        mouse: {
            track: true,
            relative: true
        },
        yaxis: {
            min: 0,
            autoscaleMargin: 1
        },
        legend: {
            backgroundColor: '#D2E8FF'
        }
    });
})(document.getElementById("barras-{{$competition->name}}"));
</script>
    </div>
</div>
@endforeach

