@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\CityController@update',$city_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="city_name" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                <input type="text" class="form-control" name="city_name" id="city_name" placeholder="" value="{{$city->city_name}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('city/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection