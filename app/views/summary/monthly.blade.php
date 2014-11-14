@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - รายงานประจำเดือน</title>
@stop

@section('body')
<style>

#chart svg {
  height: 400px;
}

</style>


<div id="chart">
  <svg></svg>
</div>
<p class="text-right"><small >* หน่วยบาท</small></p>
<div class="well">
  <h2>รายงานการขายประจำเดือน {{$date}}</h2>
  <h3>ยอดขาย {{$report['total']}} ฿</h3>
  <h3>ต้นทุน {{$report['cost']}} ฿</h3>
  <h3>กำไรสุทธิ {{$report['net']}} ฿</h3>  

</div>
@stop

@section('js')
  <link href="/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css">
  <script src="/nvd3/d3.v3.js"></script>
  <script src="/nvd3/nv.d3.js"></script>

<script>
  //Regular pie chart example
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true);

    d3.select("#chart svg")
        .datum(exampleData())
        .transition().duration(350)
        .call(chart);

  return chart;
});

//Donut chart example
nv.addGraph(function() {
  var chart = nv.models.pieChart()
      .x(function(d) { return d.label })
      .y(function(d) { return d.value })
      .showLabels(true)     //Display pie labels
      .labelThreshold(.05)  //Configure the minimum slice size for labels to show up
      .labelType("percent") //Configure what type of data to show in the label. Can be "key", "value" or "percent"
      .donut(true)          //Turn on Donut mode. Makes pie chart look tasty!
      .donutRatio(0.35)     //Configure how big you want the donut hole size to be.
      ;

    d3.select("#chart svg")
        .datum(exampleData())
        .transition().duration(350)
        .call(chart);

  return chart;
});

//Pie chart example data. Note how there is only a single array of key-value pairs.
function exampleData() {
  return  [
  @foreach ($history as $data)
    { 
      "label": "{{$data->get('item')[0]->get('item')->get('name')}}",
      "value" : {{$data->get('item')[0]->get('quantity')*$data->get('item')[0]->get('price')}}
    },
  @endforeach
    ];
}
</script>
@stop