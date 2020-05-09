<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col-md-3">
        {!! $chart->container() !!}
    </div>
    {!! $chart->script() !!}

</div>
 </body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" charset="utf-8"></script>

</html>