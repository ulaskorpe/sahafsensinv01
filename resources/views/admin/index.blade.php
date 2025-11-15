@extends("admin.main_layout")


@section('content')

    @include("admin.partials.dashboard")
@endsection




@section('scripts')
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
@endsection

