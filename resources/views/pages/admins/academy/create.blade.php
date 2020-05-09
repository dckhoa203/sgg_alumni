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
            <form action="{{route('khoa-vien/them/submit')}}" method="post">
                @csrf
                    <h4>Mã khoa</h4>
                    <input type="text" name="academy_code" class="form-control" id="academy_code">
                    <h4>Tên khoa</h4>
                    <input type="text" name="academy_name" class="form-control" id="academy_name" />
                    <h4>Mô tả khoa</h4>
                    <input type="text"  name="academy_description" class="form-control" id="academy_description"><br>
                    <button style="width:80px" class="btn btn-success" type="submit">Lưu</button>
                    <a style="width:80px" href="{{route('khoa-vien/index')}}" class="btn btn-default">Trở lại</a>
            </form>
        </div>
    </div>

@endsection