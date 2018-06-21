@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <form action="{{url('graphreport')}}" method="GET" role="search" class="form-horizontal">
  <div class="row">
    <div class="col-md-12"  >
      {{ csrf_field() }} 
      <div class="row">
        <div class="col-md-3"  >
          <div class="input-group">
            <label for="staticEmail" class="col-sm-3 col-form-label">District:</label>
            <div class="col-sm-9">    
              <select class="form-control" name="dist_id">
                  <option value="0">--All District--</option>
                  @foreach($dist as $dist)
                    <option value="{{$dist->id}}" " {{ $dist->id == $request->dist_id ? 'selected="selected"' : '' }}">{{$dist->districtname}}</option>
                  @endforeach
              </select>       
            </div>  
          </div>
        </div>
        
        <div class="col-md-4" >
          <div class="input-group">
            <label for="staticEmail" class="col-sm-4 col-form-label">From Date:</label>
            <div class="col-sm-7">
              <input id="date1" type="text" autocomplete="off" 
              class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" 
              name="date1" value="{{ $request->date1 }}"> 
            </div>
          </div>
        </div>   
        <div class="col-md-4" >
          <div class="input-group">
            <label for="staticEmail" class="col-sm-3 col-form-label">To Date:</label>
            <div class="col-sm-7">
              <input id="date2" type="text" autocomplete="off" 
              class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" 
              name="date2" value="{{ $request->date2 }}"> 
            </div>
          </div>
        </div>  
        <div class="col-md-1" > 
            <button type="submit" class="btn btn-info"> Search
            </button> 
        </div> 
      </div>
    </div> 
  </div>
  </form>
<div class="row p-1">
  <div class="col-md-12">
    @if( count(json_decode($result))  > 1 ) 
    <div id="chart_div" style="height:500px;"></div> 
    @else
    No Records
    @endif
  </div>

</div>
<div class="row p-1">
  <div class="col-md-12 p-1">
  
  @if( count(json_decode($resultline))  > 1) 
    <div id="chart_line" style="height:500px;"></div>
    
    @endif
  </div>
</div>

<script type="text/javascript">
var result = <?php echo $result; ?>; 
var resultline = <?php echo $resultline; ?>;   
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart); 
 google.charts.setOnLoadCallback(linechart);  
function drawChart() {  
   var data = google.visualization.arrayToDataTable(result);

      var view = new google.visualization.DataView(data);
      view.setColumns([0,
      1, {
        calc: function (dt, row) {
          return dt.getValue(row, 1);
        },
        type: "number",
        role: "annotation"
      },
      2, {
        calc: function (dt, row) {
          return '';
        },
        type: "string",
        role: "annotation"
      },
      {
        calc: function (dt, row) {
          return 0;
        },
        label: "Total Enrolled",
        type: "number",
      },
      {
        calc: function (dt, row) { 
          return dt.getValue(row, 1) + dt.getValue(row, 2);
        },
        type: "number",
        role: "annotation"
      }
    ]);

      var options = {
        animation:{
          duration: 1000,
          easing: 'out',
          startup: true
        },
        title: "Daily Progress Data",
        vAxis: {title: 'Enrollment Data'}, isStacked: true,
        hAxis: {title: 'Date'} 
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
      chart.draw(view, options);
     
}

function linechart() {
  var data = google.visualization.arrayToDataTable(resultline);
    var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);

      var options = {
        animation:{
          duration: 1000,
          easing: 'out',
          startup: true
        },
        vAxis: {title: 'Total Progress in Enrollment'},
        hAxis: {title: 'Date'} ,
        legend: 'none',
        pointSize: 10,
        title: 'Rate of Progress Chart', 
      };
      var chart = new google.visualization.ComboChart(document.getElementById("chart_line"));
      chart.draw(view, options);
}
</script>
@endsection