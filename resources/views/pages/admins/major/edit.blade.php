@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <div class="white-box m-auto">
    <form action="{{action('Master\MajorController@update',$major_id)}}" method="POST">
        @csrf
        <fieldset class="form-group row">
            <label for="academy_code" class="col-sm-1-12 col-form-label">Mã khoa:</label>
            <select name="academy_id" class="form-control pull-right">
                @foreach($khoa as $k)
                <option value="{{$k->academy_id}}" @if($k->academy_id == $major->academy_id) selected @endif>{{$k->academy_name}}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="form-group row">
            <label for="major_code" class="col-sm-1-12 col-form-label">Mã ngành:</label>
                <input type="text" class="form-control" name="major_code" id="major_code" placeholder="" value="{{$major->major_code}}">
        </fieldset>
        <fieldset class="form-group row">
            <label for="major_name" class="col-sm-1-12 col-form-label">Tên ngành:</label>
                <input type="text" class="form-control" name="major_name" id="major_name" placeholder="" value="{{$major->major_name}}">
        </fieldset>
        <div class="form-group row">
            <label for="major_description" class="col-sm-1-12 col-form-label">Mô tả ngành:</label>
                <input type="text" class="form-control" name="major_description" id="major_description" placeholder="" value="{{$major->major_description}}">
        </div>
        <div class="form-group">
            <button style="width:80px" type="submit" class="btn btn-success">Lưu</button>
            <a style="width:80px" href="{{route('major/index')}}" class="btn btn-default">Trở lại</a>
        </div>
    </form>
    </div>
</div>
@endsection