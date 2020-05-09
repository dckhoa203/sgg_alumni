@yield('css_link')
    <!-- Calendar CSS -->
    <link href="{{asset('/plugins/bower_components/calendar/dist/fullcalendar.css')}}" rel="stylesheet" />
<style>
        .panel-default:not(.index){
            background-color: #E6E6FA;
        }
        /* .panel-heading{
            background-color: red;
        }*/
        .jumbotron{
            background-color: white;
            height: 30em;
        }
        /*
        .col-md-2 img{
            height: 300px;
        } 
        .col-md-8:not(.index){
            position: absolute;
            left: 30em;
        } */
        .title{
            color: #2570BB;
            font-family: 'Roboto Condensed', Arial, sans-serif;
            text-transform: uppercase;
        }
        .title h3{
            color:#2570BB;
            font-weight: 400;
        }
        .title_class_name{
            color:cornflowerblue;
        }
        #public-methods{
            background: #E6E6FA;
        }
        body{
            font-size: 12px;
        }
        a i{
            font-size:15px!important;
        }
        button i{
            font-size:15px!important;
        }
</style>

{{-- TODO: IMPUT GIAO DIỆN THÊM NGÀY SURVEY --}}
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