@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('city/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="city_name" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                    <input type="text" class="form-control" name="city_name" id="city_name" placeholder="" value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{route('city/index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        
    </script>
@endsection