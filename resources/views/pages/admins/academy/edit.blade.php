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
    <form action="{{action('Master\AcademyController@update',$academy_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="academy_code" class="col-sm-1-12 col-form-label">Mã khoa:</label>
                <input type="text" class="form-control" name="academy_code" id="academy_code" placeholder="" value="{{$academy->academy_code}}">
        </div>
        <fieldset class="form-group row">
            <label for="academy_name" class="col-sm-1-12 col-form-label">Tên khoa:</label>
                <input type="text" class="form-control" name="academy_name" id="academy_name" placeholder="" value="{{$academy->academy_name}}">
        </fieldset>
        <div class="form-group row">
            <label for="academy_description" class="col-sm-1-12 col-form-label">Mô tả khoa:</label>
                <input type="text" class="form-control" name="academy_description" id="academy_description" placeholder="" value="{{$academy->academy_description}}">
        </div>
        <div class="form-group">
            <button style="width:80px" type="submit" class="btn btn-success">Lưu</button>
            <a style="width:80px" href="{{route('khoa-vien/index')}}" class="btn btn-default">Trở lại</a>
        </div>
    </form>
    </div>  
</div>
@endsection