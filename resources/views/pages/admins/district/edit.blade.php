@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\DistrictController@update',$district_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="district_name" class="col-sm-1-12 col-form-label">Tên huyện:</label>
                <input type="text" class="form-control" name="district_name" id="district_name" placeholder="" value="{{$district->district_name}}">
        </div>
        <div class="form-group row">
            <label for="city_id" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                <select name="city_id" class="form-control pull-right">
                    @foreach($city as $item)
                    <option value="{{$item->city_id}}" @if($item->city_id == $district->city_id) selected @endif>{{$item->city_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('district/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection