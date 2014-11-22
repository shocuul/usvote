
{{$hoy}}
{{var_dump($finalizado)}}
@foreach ($finalizado as $competition ) 
<div id="grafica-{{$competition->name}}" style="width:600px; height: 400px; margin: 8px auto;"></div>

<script>
	(function basic_pie(container) {
    var
    d1 = [
        [0, 18]
    ],
        d2 = [
            [0, 10]
        ],
        d3 = [
            [0, 5]
        ],
        graph;

    graph = Flotr.draw(container, [{
        data: d1,
        label: '{{$competition->name}}'
    }, {
        data: d2,
        label: 'Lucas Benavides'
    }, {
        data: d3,
        label: 'Cristina Esquivel',
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

@endforeach

