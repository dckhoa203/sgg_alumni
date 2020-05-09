@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('district/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="district_name" class="col-sm-1-12 col-form-label">Tên huyện:</label>
                    <input type="text" class="form-control" name="district_name" id="district_name" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="city_id" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                    <select name="city_id" class="form-control pull-right">
                        <option value="">Chọn tỉnh</option>
                        @foreach($city as $item)
                        <option value="{{$item->city_id}}">{{$item->city_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('district/index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        
    </script>
@endsection