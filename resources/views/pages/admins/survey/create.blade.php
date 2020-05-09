@extends('layouts.admin')
@section('content')
  @if (count($errors) > 0)
     <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
             <li>{{  $error}}    </li>
          @endforeach
        </ul>
      </div>
  @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-sm-6 m-auto">
            <div class="white-box">
    <form action="create_submit" method="post" id="boolean">
        @csrf
        <div class="form-group">
            <h4>Tiêu đề khảo sát</h4>
            <input type="text" class="form-control" name="survey_name" id="survey_name">
        </div>
        <div class="form-group">
            <h4>Đối tượng khảo sát</h4>
            <select name="role_id" class="form-control pull-right">
                <option value='4'>Sinh viên</option>
                <option value='3'>Cựu sinh viên</option>
                <option value='2'>Giáo viên</option>
            </select>
        </div>
        <div class="form-group">
            <h4>Thời gian khảo sát</h4>
            <input type="datetime-local text" class="form-control datetime" name="survey_time" id="survey_time">
        </div>
        <div class="form-group">
            <h4>Mô tả</h4>
            <textarea type="text" class="form-control" rows="5" name="survey_description" id="survey_description"></textarea>
        </div>
        <div class="form-group">
            <h4>Phiên bản</h4>
            <input type="text" class="form-control" name="survey_version" id="survey_version">
        </div>
            <br>

            <button style="width:80px" class="btn btn-primary" type="submit">Lưu</button>
            <a style="width:80px" href="{{route('survey.index')}}" class="btn btn-default">Trở lại</a>
    </form>  
            </div>
  </div>

@endsection
@section('script')
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