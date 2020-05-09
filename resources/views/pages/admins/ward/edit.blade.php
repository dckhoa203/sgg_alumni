@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\WardController@update',$ward_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="ward_name" class="col-sm-1-12 col-form-label">Tên xã:</label>
                <input type="text" class="form-control" name="ward_name" id="ward_name" placeholder="" value="{{$ward->ward_name}}">
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                <select name="city_id" class="form-control pull-right" id="city">
                    @foreach($city as $item)
                        <option value="{{$item->city_id}}" @if($item->city_id == $ward->district->city_id) selected @endif>{{$item->city_name}}</option>
                        @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="district" class="col-sm-1-12 col-form-label">Tên huyện:</label>
                <select name="district_id" class="form-control pull-right" id="district">
                    @foreach($district as $item)
                        <option value="{{$item->district_id}}" @if($item->district_id == $ward->district_id) selected @endif>{{$item->district_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('ward/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#city").change(function(){
                var city_id = $(this).val();
                $.get("../../ward/district/"+city_id, function(data){
                    $("#district").html(data);
                });
            });
        });
    </script>
@endsection