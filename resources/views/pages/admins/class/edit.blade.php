@extends('layouts.admin')

@section('content')
@if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
    @endif
    @if($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error}}    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
    input#them_gv {
    border-color: #e8e8e8!important;
    border-top: none;
    border-right: none;
    border-left: none;
    font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
    font-size: inherit;
    line-height: inherit;
    line-height: 135%;
    height: 40px;
    width: 50%
    }
    input#them_gv:focus-within {
        border-color: green!important;
    }
    </style>
<div class="row">
    
    <div class="white-box m-auto col-sm-6">
        <form action="{{action('Master\ClassController@update',$class_id)}}" method="POST">
            @csrf
            <fieldset class="form-group row">
                <label for="major_branch_code" class="col-sm-1-12 col-form-label">Ngành:</label>
                <select name="major_id" id='major' class="form-control pull-right">
                    @foreach($nganh as $n)
                    <option value="{{$n->major_id}}" @if($n->major_id == $class->major_id) selected @endif>{{$n->major_name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-group row">
                <label for="major_branch_code" class="col-sm-1-12 col-form-label">Chuyên ngành:</label>
                <select name="major_branch_id" id='major_branch' class="form-control pull-right">
                        <option value=0>Không</option>
                        @foreach($chuyennganh as $cn)
                        <option value="{{$cn->major_branch_id}}" @if($cn->major_branch_id == $class->major_branch_id) selected @endif>{{$cn->major_branch_name}}</option>
                        @endforeach
                </select>
            </fieldset>
            <fieldset class="form-group row">
                <label for="class_code" class="col-sm-1-12 col-form-label">Mã lớp:</label>
                <input type="text" class="form-control" name="class_code" id="class_code" value="{{$class->class_code}}">
            </fieldset>
            <fieldset class="form-group row">
                <label for="class_code" class="col-sm-1-12 col-form-label">Tên lớp:</label>
                <input type="text" class="form-control" name="class_name" id="class_name" value="{{$class->class_name}}">
            </fieldset>
            <fieldset class="form-group row">
                <label for="class_code" class="col-sm-1-12 col-form-label">Mã giáo viên cố vấn:</label>
                @foreach ($teacher as $item_1)
                    @if($username != null)
                        @foreach ($username as $item_2)
                            @if($item_1->username == $item_2)
                                <input type="checkbox" name="teacher_old[]" value="{{$item_1->username}}" checked>{{$item_1->username." - ". $item_1->name}}<br>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </fieldset>
                <div class="form-g" id="form-g"></div>
                <div class="add-option" style="cursor:pointer; color:green; margin-top:5px; width:100px;" onclick="scroll()">Thêm cố vấn</div>
            
            <fieldset class="form-group row">
                <label for="class_begin" class="col-sm-1-12 col-form-label">Năm bắt đầu:</label>
                <input type="date" class="form-control" id="class_begin" name="class_begin"  value="{{$class->class_begin}}">
            </fieldset>
            
            <div class="form-group">
                <button style="width:80px" type="submit" class="btn btn-success">Lưu</button>
                <a style="width:80px" href="{{route('class/index')}}" class="btn btn-default">Trở lại</a>
            </div>
        </form>
    </div>{{-- end div white-box --}}
</div>{{-- end div row --}}
@endsection
@section('script')
<script>
    $(document).on('click', '.add-option', function() {
    $(".form-g").append(material);
  });

  // will replace .form-g class when referenced
  var material = '<div class="input-field col input-g s12"><br>' +
    '<input name="teacher_new[]"  type="text" id="them_gv" autocomplete="off" placeholder="Mã giáo viên">' +
    '<span style="margin-left:50px; color:red; cursor:pointer;"class="delete-option">Xóa</span><br>' +

    // '<label for="question_option">Options</label><br>' +
  
    '</div>';
    $(document).on('click', '.delete-option', function() {
    $(this).parent(".input-field").remove();
    });
    $('form-g').scrollspy({target: ".submit"})
    $(document).ready(function(){
        // Ajax
        $("#major").change(function(){
            var major_id = $(this).val();
            $.get("../class/major_branch/"+major_id, function(data){
                $("#major_branch").html(data);
            });
        });
    });
</script>
@endsection