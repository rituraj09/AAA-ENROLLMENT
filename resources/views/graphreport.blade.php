@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
  <form action="{{url('graphreport')}}" method="GET" role="search">
    <div class="col-md-12"> 
      <div class="input-group">
          {{ csrf_field() }}
          <label for="staticEmail" class="col-sm-2 col-form-label">District:</label>
          <div class="col-sm-7">    
            <select class="form-control" name="dist_id">
                <option value="0">--All District--</option>
                @foreach($dist as $dist)
                  <option value="{{$dist->id}}" " {{ $dist->id == $request->dist_id ? 'selected="selected"' : '' }}">{{$dist->districtname}}</option>
                @endforeach
            </select>       
          </div>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-info"> Search
            </button>
          </span>
      </div>
    </div>
  </form>
</div>
<div class="row p-1">
  <div class="col-md-12">
    <div id="chart_div" style="height:500px;"></div>
  </div>
</div>
<div class="row p-1">
  <div class="col-md-12 p-1">
    <div id="chart_line" style="height:500px;"></div>
  </div>
</div>

<script type="text/javascript">
var result = <?php echo $result; ?>; 
var resultline = <?php echo $resultline; ?>;  
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawVisualization); 
 google.charts.setOnLoadCallback(linechart);

 function drawVisualization() {
  google.charts.load('current', {
  callback: drawChart,
  packages:['corechart']
});

function drawChart() { 

  // Some raw data (not necessarily accurate)
  var data = google.visualization.arrayToDataTable(result);
    
    
  var options = {
    animation:{
        duration: 1000,
        easing: 'out',
        startup: true
      },
  title : 'Daily Progress Data',
  vAxis: {title: 'Enrollment Data'}, isStacked: true,
  hAxis: {title: 'Date'},
  seriesType: 'bars' 
  };

var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));  
chart.draw(data, options);
}
}

function linechart() {
   // Some raw data (not necessarily accurate)
   var data = google.visualization.arrayToDataTable(resultline);
  

   var options = {
    animation:{
      duration: 1000,
      easing: 'out',
      startup: true
    },
    legend: 'none',
    pointSize: 10,
    title: 'Company Performance', 
  };

var chart = new google.visualization.ComboChart(document.getElementById('chart_line'));
chart.draw(data, options);
}
</script>
@endsection