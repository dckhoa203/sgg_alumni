@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('work_user/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="user" class="col-sm-1-12 col-form-label">MSSV:</label>
                    <select name="user_id" class="form-control pull-right" id="user">
                        <option value="" selected>--Chọn MSSV--</option>
                        @foreach($user as $item)
                        <option value="{{$item->user_id}}">{{$item->user_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group row">
                <label for="work" class="col-sm-1-12 col-form-label">Tên công ty:</label>
                    <select name="work_id" class="form-control pull-right" id="work">
                        <option value="" selected>--Chọn công ty--</option>
                        @foreach($work as $item)
                        <option value="{{$item->work_id}}">{{$item->work_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group row">
                <label for="work_user_salary" class="col-sm-1-12 col-form-label">Lương:</label>
                    <input type="text" class="form-control" name="work_user_salary" id="work_user_salary" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="work_user_begin" class="control-label">Thời gian bắt đầu:</label>
                <input type="date" class="form-control" id="work_user_begin" name="work_user_begin" placeholder="" value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('work_user/index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
@endsection
