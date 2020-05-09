@extends('layouts.admin')
@section('content')
<div id="page-wrapper">
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
    <div class="container-fluid">
        <form action="{{ route('statistic.show') }}" method="post" class="export">
            @csrf
            <select id="survey" name="survey">
                @foreach ($data as $item)
                    <option value="" selected>--Chọn khảo sát--</option>
                    <option value="{{$item['survey_id']}}">{{$item['survey_name']}}</option>
                @endforeach
            </select>
            <select id="question" name="question">
                    <option value="" selected>--Chọn câu hỏi--</option>
            </select>
            <button type="submit" id="submit" class="btn btn-danger">Thống kê</button>
        </form>
        
    </div>
    {{-- end div container-fluid --}}
</div>
{{-- end div page-wrapper --}}

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('#survey').on('change',function(){
                var survey_id = $('#survey').val();
                $.get("statistic/showsurvey/"+survey_id, function(data){
                    $("#question").html(data);
                });
            });
        });
    </script>
@endsection