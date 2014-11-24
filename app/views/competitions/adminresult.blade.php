
<p></p>
<p></p>
<p></p>
@foreach ($finalizado as $competition ) 
<div class="panel panel-success">
    <div class="panel-heading"><strong>Nombre del concurso:</strong> {{$competition->name}}</div>
    <div class="panel-body">
        <p class="text-center"><strong>Grafica</strong></p>   
        <div id="grafica-{{$competition->name}}" style="width:600px; height: 400px; margin: 8px auto;"></div>
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
    @foreach ($competition->students as $student)
    @if($student)
    var d{{$jshelper}} = [[0, {{$student->pivot->votes}}]];
    var label{{$jshelper}} = '{{$student->user->firstname ." ". $student->user->lastname}}';
    {{$jshelper = $jshelper + 1}}
    @endif
@endforeach
    console.log(d1);
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
</script>
    </div>
</div>

@endforeach

