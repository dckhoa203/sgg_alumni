@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="white-box m-auto">
    <form action="{{route('class/create_quick/submit')}}" method="post">
        @csrf
            <h4>Ngành:</h4>
            <select name="major_id" id="major" class="form-control pull-right">
                @foreach($nganh as $n)
                    <option value="{{$n->major_id}}">{{$n->major_code}} - {{$n->major_name}}</option>
                @endforeach
            </select>
            <br><br>
            <h4>Chuyên ngành:</h4>
            <select name="major_branch_id" id="major_branch" class="form-control pull-right">
                <option value=0>Không</option>
            </select>
            <br><br>
            <h4>Số lớp:</h4>
            <input type="number"  name="class_number" id="class_number" class="form-control pull-right" >
            <br><br>
            <h4>Năm bắt đầu:</h4>
            <input type="date" class="form-control" id="class_begin" name="class_begin" placeholder="class_begin">
            <br>
            <h4>Năm kết thúc:</h4>
            <input type="date" class="form-control" id="class_end" name="class_end" placeholder="class_end">
            <br>
            <button class="btn btn-success" type="submit">Lưu</button>
            <a href="{{route('class/index')}}" class="btn btn-default">Trở lại</a>
        </form>
        </div>{{-- end div white-box --}}
    </div>{{-- end div row --}}

@endsection
@section('script')
<script>
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