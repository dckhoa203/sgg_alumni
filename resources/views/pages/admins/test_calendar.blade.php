@extends('layouts.admin')
@section('content')
    
<link href="{{asset('/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Page plugins css -->
    {{-- <link href="{{asset('/node_modules/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet"> --}}
    {{-- <!-- Color picker plugins css -->
    <link href="{{asset('/plugins/bower_components/jquery-asColorPicker-master/dist/css/asColorPicker.css')}}" rel="stylesheet"> --}}
    <!-- Date picker plugins css -->
    <link href="{{asset('/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{asset('/plugins/bower_components/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
   <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <!-- Date And Time -->
                                <h5 class="card-title m-t-30">Date and Time</h5>
                                <h6 class="card-subtitle">These picker is used for when you want to choose start date to end date with particuler time
                                    for both start date and end date.</h6>
                                <div class='input-group mb-3'>
                                    <input type='text' class="form-control datetime" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <!-- 24 hour Time Picker with Seconds -->
                                <h5 class="card-title m-t-30">Seconds with 24 hour Time</h5>
                                <h6 class="card-subtitle">These picker is used for when you want to choose start date to end date with particuler time
                                    for both start date and end date and to choose specific second from 24 hours.</h6>
                                <div class='input-group mb-3'>
                                    <input type='text' class="form-control timeseconds" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
<!-- Plugin JavaScript -->
<script src="{{asset('/plugins/bower_components/moment/moment.js')}}"></script>
<script src="{{asset('/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<!-- Clock Plugin JavaScript -->
<script src="{{asset('/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
<!-- Color Picker Plugin JavaScript -->
{{-- <script src="{{asset('/node_modules/jquery-asColor/dist/jquery-asColor.js')}}"></script> --}}
{{-- <script src="{{asset('/node_modules/jquery-asGradient/dist/jquery-asGradient.js')}}"></script> --}}
<script src="{{asset('/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{asset('/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{asset('/plugins/bower_components/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>

// Date & Time
$('.datetime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY h:mm A'
    }
});

//Calendars are not linked
$('.timeseconds').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    timePicker24Hour: true,
    timePickerSeconds: true,
    locale: {
        format: 'MM-DD-YYYY h:mm:ss'
    }
});







</script>
@endsection
