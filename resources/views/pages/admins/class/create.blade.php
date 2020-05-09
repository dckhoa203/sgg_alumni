@extends('layouts.admin')
@section('content')
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
    <div class="row">
        <div class="white-box m-auto">
            <form action="{{route('class/create/submit')}}" method="post">
                @csrf
                    <h4>Ngành:</h4>
                    <select name="major_id" id="major" class="form-control pull-right">
                        @foreach($nganh as $n)
                            <option value="{{$n->major_id}}">{{$n->major_name}}</option>
                        @endforeach
                    </select>
                    <h4>Chuyên ngành:</h4>
                    <select name="major_branch_id" id="major_branch" class="form-control pull-right">
                        <option value=0>Không</option>
                    </select>
                    <h4>Mã lớp:</h4>
                    <input type="text"  name="class_code" id="class_code" class="form-control pull-right">
                    <h4>Tên lớp</h4>
                    <input type="text"  name="class_name" id="class_name" class="form-control pull-right">
                    <h4>Mã giáo viên cố vấn</h4>
                    <input type="text"  name="teacher[]" id="teacher" class="form-control pull-right">
                    <br><br>
                    {{-- <div id='hgv'> --}}
                            <div class="form-g" id="form-g"></div>
                            <div class="add-option" style="cursor:pointer; color:green; margin-top:5px; width:100px;" onclick="scroll()">Thêm cố vấn</div>

                    {{-- <h4>Học kỳ bắt đầu</h4>
                    <select name="class_semester_begin" id="class_semester_begin" class="form-control pull-right">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select> --}}
                    <h4>Năm bắt đầu</h4>
                    <input type="date" class="form-control" id="class_begin" name="class_begin"  value="">
                    <br>
                    <button style="width:80px" class="btn btn-success" type="submit">Lưu</button>
                    <a style="width:80px" href="{{route('class/index')}}" class="btn btn-default">Trở lại</a>
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
    '<input name="teacher[]"  type="text" >' +
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