@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\RoleSurveyController@update',$role_survey_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="role_id" class="col-sm-1-12 col-form-label">Role ID:</label>
                <input type="text" class="form-control" name="role_id" id="role_id" placeholder="" value="{{$rolesurvey->role_id}}">
        </div>
        <fieldset class="form-group row">
            <label for="academy_id" class="col-sm-1-12 col-form-label">Academy ID:</label>
                <input type="text" class="form-control" name="academy_id" id="academy_id" placeholder="" value="{{$rolesurvey->academy_id}}">
        </fieldset>
        <div class="form-group row">
            <label for="class_id" class="col-sm-1-12 col-form-label">Class ID:</label>
                <input type="text" class="form-control" name="class_id" id="class_id" placeholder="" value="{{$rolesurvey->class_id}}">
        </div>
        <div class="form-group row">
            <label for="survey_id" class="col-sm-1-12 col-form-label">Survey ID:</label>
                <input type="text" class="form-control" name="survey_id" id="survey_id" placeholder="" value="{{$rolesurvey->survey_id}}">
    
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('surveys/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection