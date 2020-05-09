@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('ward/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="ward_name" class="col-sm-1-12 col-form-label">Tên xã:</label>
                    <input type="text" class="form-control" name="ward_name" id="ward_name" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                    <select name="city_id" class="form-control pull-right" id="city">
                        <option value="">Chọn tỉnh</option>
                        @foreach($city as $item)
                        <option value="{{$item->city_id}}">{{$item->city_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group row">
                <label for="district_id" class="col-sm-1-12 col-form-label">Tên Huyện:</label>
                    <select name="district_id" class="form-control pull-right" id="district">
                        <option value="">Chọn quận, huyện</option>
                    </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
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
                $.get("../ward/district/"+city_id, function(data){
                    $("#district").html(data);
                });
            });
        });
    </script>
@endsection