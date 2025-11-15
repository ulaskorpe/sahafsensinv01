@extends("admin_panel.main_layout")
@php
    $show_graphs= false;
@endphp

@section('content')

<canvas id="dailyChart"></canvas>
<div id="regions_div" style="width: 100%; height: 500px;"></div>

@if($show_graphs)
    @include("admin_panel.partials.dashboard_graphs")
    @endif
@endsection




@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="../../../robust-assets/js/plugins/charts/chart.min.js" type="text/javascript"></script>

<!-- jVectorMap: world map için -->
<script src="../../../robust-assets/js/plugins/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="../../../robust-assets/js/plugins/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>

<!-- (Opsiyonel) moment.js: Chart.js tooltip için tarih formatlama kullanırsan -->
<script src="../../../robust-assets/js/plugins/extensions/moment.min.js" type="text/javascript"></script>


<script>
    var dailyCtx = document.getElementById('dailyChart').getContext('2d');
   
   var dailyChart = new Chart(dailyCtx, {
       type: 'bar',
       data: {
           labels: {!! json_encode($dailyData->pluck('date')) !!},
           datasets: [
               {
                   label: 'Tekil IP',
                   data: {!! json_encode($dailyData->pluck('unique_ips')) !!},
                   backgroundColor: 'rgba(54, 162, 235, 0.7)',
                   borderColor: 'rgba(54, 162, 235, 1)',
                   borderWidth: 1
               },
               {
                   label: 'Toplam Ziyaret',
                   data: {!! json_encode($dailyData->pluck('total_visits')) !!},
                   backgroundColor: 'rgba(255, 99, 132, 0.7)',
                   borderColor: 'rgba(255, 99, 132, 1)',
                   borderWidth: 1
               }
           ]
       },
       options: {
           responsive: true,
           scales: {
               y: {
                   beginAtZero: true
               }
           }
       }
   });
   
   
       google.charts.load('current', {
           'packages':['geochart'],
       });
   
       google.charts.setOnLoadCallback(drawRegionsMap);
   
       function drawRegionsMap() {
   
           var data = google.visualization.arrayToDataTable([
               ['Country', 'Toplam Ziyaret'],
               @foreach($countryData as $country)
                   ['{{ $country->country }}', {{ $country->total_visits }}],
               @endforeach
           ]);
   
           var options = {};
   
           var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
   
           chart.draw(data, options);
       }
   </script>

@if($show_graphs)
<script src="{{ url('/robust-assets/js/plugins/extensions/jquery.knob.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/chartist.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/chartist-plugin-tooltip.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/charts/jvector/jquery-jvectormap-world-mill.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/extensions/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/extensions/underscore-min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/extensions/clndr.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/plugins/extensions/unslider-min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/components/pages/dashboard-project.js') }}" type="text/javascript"></script>
@endif
@endsection

