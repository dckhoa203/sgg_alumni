@extends('layouts.admin')
@section('content')
@if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error}}    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="white-box m-auto">
    <form action="{{route('major/create/submit')}}" method="post">
        @csrf
            <h4>Mã khoa</h4>
                <select name="academy_id"  class="form-control pull-right">
                    @foreach($khoa as $k)
                        <option value="{{$k->academy_id}}">{{$k->academy_name}}</option>
                    @endforeach
                </select>
            <h4>Mã ngành</h4>
            <input type="text" name="major_code" class="form-control" id="major_code">
            <h4>Tên ngành</h4>
            <input type="text" name="major_name" class="form-control" id="major_name" />
            <h4>Mô tả ngành</h4>
            <input type="text"  name="major_description" class="form-control" id="major_description"><br>
            <button class="btn btn-success" type="submit">Lưu</button>
            <a href="{{route('major/index')}}" class="btn btn-default">Trở lại</a>
        </form>
    </div>
    </div>

@endsection
@section('script')
    <script>
        
    </script>
@endsection