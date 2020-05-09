@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\WorkUserController@update',$work_user_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="user" class="col-sm-1-12 col-form-label">MSSV:</label>
                <select name="user_id" class="form-control pull-right" id="user">
                    @foreach($user as $item)
                    <option value="{{$item->user_id}}" @if($item->user_id == $work_user->user_id) selected @endif>{{$item->code}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="work" class="col-sm-1-12 col-form-label">Tên công ty:</label>
                <select name="work_id" class="form-control pull-right" id="work">
                    @foreach($work as $item)
                    <option value="{{$item->work_id}}" @if($item->work_id == $work_user->work_user_id) selected @endif>{{$item->work_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="work_user_salary" class="col-sm-1-12 col-form-label">Lương:</label>
            <input type="text" class="form-control" name="work_user_salary" id="work_user_salary" placeholder="" value="{{$work_user->work_user_salary}}">
        </div>
        <div class="form-group row">
            <label for="work_user_begin" class="control-label">Thời gian bắt đầu:</label>
            <input type="date" class="form-control" id="work_user_begin" name="work_user_begin" placeholder="" value="{{$work_user->work_user_begin}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('work/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection