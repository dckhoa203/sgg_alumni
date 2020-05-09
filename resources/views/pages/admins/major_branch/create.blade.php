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
    <div class="row">
        <div class="white-box m-auto">
    <form action="{{route('major_branch/create/submit')}}" method="post">
        @csrf
            <h4>Mã ngành</h4>
            <select name="major_id"  class="form-control pull-right">
                @foreach($nganh as $n)
                    <option value="{{$n->major_id}}">{{$n->major_name}}</option>
                @endforeach
            </select>
            <br><br>
            <h4>Tên chuyên ngành</h4>
            <input type="text"  name="major_branch_name" class="form-control" id="major_branch_name"><br>
            <button style="width:80px"  class="btn btn-success" type="submit">Lưu</button>
            <a style="width:80px" href="{{route('major_branch/index')}}" class="btn btn-default">Trở lại</a>
        </form>
        </div>
    </div>

@endsection