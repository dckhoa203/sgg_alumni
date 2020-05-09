@extends('layouts.admin')
@section('content')
<div class="row">
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
            </div>
        @endif
    <div class="col-sm-6 m-auto">
        <form action="{{route('teacher.update',$user_id)}}" method="POST">
            @csrf
            <div class="white-box ">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center align-middle"><p class="text-primary">Thông tin giáo viên</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-right align-middle">Mã giáo viên</th>
                                <th><input class="form-control" type="text" name="code" id="code" value="{{$teacher->username}}" ></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Tên giáo viên</th>
                                <th><input class="form-control" type="text" name="name" id="name" value="{{$teacher->name}}" ></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Giới tính</th>
                                <th><input class="form-control" type="text" name="gender" id="gender" value="{{$teacher->gender}}" ></th>                        
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Dân tộc</th>
                                <th><input class="form-control" type="text" name="nation" id="nation" value="{{$teacher->nation}}" ></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Ngày sinh</th>
                                <th><input class="form-control" type="date" name="birth" id="birth" value="{{$teacher->birth}}" ></th>
                            </tr>   
                            <tr>
                                <th class="text-right align-middle">Email</th>
                                <th><input class="form-control" type="text" name="email" id="email" value="{{$teacher->email}}" ></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">SĐT</th>
                                <th><input class="form-control" type="text" name="tel" id="tel" value="{{$teacher->tel}}" ></th> 
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Địa chỉ</th>
                                <th><input class="form-control" type="text" name="address" id="address" value="{{$teacher->address}}" ></th> 
                            </tr> 
                        </tbody>
                    </table>   
                
            
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('teacher.index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
</div>
    
@endsection