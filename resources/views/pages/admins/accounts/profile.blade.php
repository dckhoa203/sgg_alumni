@extends('layouts.admin')
@section('content')
<div class="white-box">
    <h3 class="box-title m-b-0">Thông tin cá nhân</h3>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{$message}}</p>
                <p class="mb-0"></p>
            </div>
            @endif
            @foreach ($accounts as $item)
                @if ($item->user_id === Auth::user()->user_id)
                <h1>Welcome,
                    {{Auth::user()->name}}
                </h1>
                <form class="form-horizontal" action="{{route('accounts/update_profile',$item->user_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="code" class="col-2 col-form-label">MSSV</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->code}}" id="code" name="code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course" class="col-2 col-form-label">Khóa</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->course}}" id="course" name="course">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Họ và tên</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->name}}" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->email}}" id="email" name="email">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->password}}" id="password" name="password">
                            </div>
                        </div> --}}
                        
                        {{-- <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Profile Image</label>
                            <div class="col-10">
                                <input class="form-control" type="file" value="" id="example-text-input">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="tel" class="col-2 col-form-label">Số điện thoại</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->tel}}" id="tel" name="tel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nation" class="col-2 col-form-label">Tôn giáo</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->nation}}" id="nation" name="nation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birth" class="col-2 col-form-label">Ngày sinh</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->birth}}" id="birth" name="birth">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-2 col-form-label">Địa chỉ</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->address}}" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            <a href="{{route('accounts/jobs')}}" class="btn btn-twitter">Công việc</a>
                        </div>
                        
                    </form>
                @endif

            @endforeach
        </div>
    </div>
</div>
@endsection