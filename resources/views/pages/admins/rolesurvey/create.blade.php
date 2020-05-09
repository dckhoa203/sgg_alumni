@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('rolesurveys/create/submit')}}" method="post">
        @csrf
        <div class="container-fluid ">
            <h4>Role ID</h4>
            <input class="form-control" type="text" name="role_id" id="role_id">
            <h4>Academy ID</h4>
            <input class="form-control"type="text" name="academy_id" id="academy_id" />
            <h4>Class ID</h4>     
            <input class="form-control" name="class_id" type="text" id="class_id">
            <h4>Survey ID</h4>
            <input class="form-control" name="survey_id" type="text" id="survey_id">
            <button class="btn btn-success" type="submit">Submit</button>
            <a href="{{route('rolesurveys/index')}}" class="btn btn-default">Back</a>
        </form>
        
    </div>
</div>

@endsection
@section('script')
    <script>
            
    </script>
@endsection