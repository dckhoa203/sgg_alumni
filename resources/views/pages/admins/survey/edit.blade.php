@extends('layouts.admin')
@section('content')
<div id="page-wrapper">
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
    </div>
    @endif
    
    <div class="white-box">
        <form method="POST" action="{{route('survey.update',$survey->survey_id)}}">
            <!-- {{ method_field('PATCH') }} -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <h2 class="flow-text">Chỉnh sửa</h2>

            <fieldset class="form-group row">
                <label class="col-sm-1-12 col-form-label" for="survey_name">Tên khảo sát</label>
                <input type="text" class="form-control" name="survey_name" id="survey_name" value="{{ $survey->survey_name }}">
            </fieldset>
            

            <fieldset class="form-group row">
                <label class="col-sm-1-12 col-form-label" for="survey_description">Mô tả</label>
                <textarea type="text" class="form-control" rows="10" name="survey_description" id="survey_description">{{ $survey->survey_description }}</textarea>
            </fieldset>
            
            <fieldset class="form-group row">
                <label class="col-sm-1-12 col-form-label" for="survey_name">Đối tượng khảo sát</label>
                <select name="role_id" class="form-control pull-right">
                    <option value='4' @if($role->role_id == 4) selected @endif>Sinh viên</option>
                    <option value='3' @if($role->role_id == 3) selected @endif>Cựu sinh viên</option>
                    <option value='2' @if($role->role_id == 2) selected @endif>Giáo viên</option>
                </select>        
            </fieldset>

            <fieldset class="form-group row">
                <label class="col-sm-1-12 col-form-label" for="survey_start">Thời gian khảo sát:</label>
                <input type="text" class="form-control datetime" name="survey_time" id="survey_time" datetime="{{ $survey_time }}" value="{{ $survey_time }}">
            </fieldset>
            <fieldset class="form-group row">
                <label class="col-sm-1-12 col-form-label" for="survey_version">Phiên bản:</label>
                <input type="text" class="form-control" name="survey_version" id="survey_version" value="{{ $survey->survey_version }}">
            </fieldset>
            <div class="form-group">
                <button style="width:80px" type="submit" class="btn btn-primary">Lưu</button>
                    <a style="width:80px" href='{{route('survey.add_new',$survey_id)}}' class="btn btn-info">Tạo mới</a>
                    <a href="{{route('survey.index')}}" class="btn btn-default">Back</a>
            </div>
        </form>  
    </div>
    
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.delete_form').on('submit',function(){
            if(confirm('Are you sure delete id??'))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    });
</script>
    <script>
        // Date & Time
        $('.datetime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY h:mm A'
            }
        });
    </script>
@endsection