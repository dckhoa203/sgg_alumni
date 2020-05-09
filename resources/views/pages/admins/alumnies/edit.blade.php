@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-6 m-auto">
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
            </div>
        @endif
        <div class="white-box">
            <form action="{{route('alumnies/update',$alumni->user_id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="code" class="control-label">MSSV</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{$alumni->code}}" placeholder="MSSV">
                </div>
                <div class="form-group">
                    <label for="course" class="control-label">Khóa</label>
                    <input type="text" class="form-control" id="course" name="course" value="{{$alumni->course}}" placeholder="Khóa">
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$alumni->name}}" placeholder="Họ và tên">
                </div>
                {{-- <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="{{$alumni->password}}" placeholder="Password">
                </div> --}}
                <div class="form-group">
                    <label for="nation" class="control-label">Dân tộc</label>
                    <input type="text" class="form-control" id="nation" name="nation" value="{{$alumni->nation}}" placeholder="Dân tộc">
                </div>  
                <div class="form-group">
                    <label for="tel" class="control-label">Số điện thoại cá nhân</label>
                    <input type="text" class="form-control" id="tel" name="tel" value="{{$alumni->tel}}" placeholder="Phone">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$alumni->email}}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="gender" class="control-label">Giới tính</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="{{$alumni->gender}}" placeholder="Gender">
                </div>
                <div class="form-group">
                    <label for="birth" class="control-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="birth" name="birth" value="{{$alumni->birth}}" placeholder="Birthday">
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$alumni->address}}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="family_tel" class="control-label">Số điện thoại gia đình</label>
                    <input type="text" class="form-control" id="family_tel" name="family_tel" value="{{$alumni->family_tel}}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="family_address" class="control-label">Địa chỉ gia đình</label>
                    <input type="text" class="form-control" id="family_address" name="family_address" value="{{$alumni->family_address}}" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="">Chọn tình trạng</label>
                    <select class="form-control" name="status_id" id="status_id">
                        @foreach ($status_alumni as $item)
                            <option value="{{$item->status_id}}">{{$item->status_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Chọn Quận/huyện</label>
                    <select class="form-control" name="status_id" id="status_id">
                        @foreach ($districts as $item)
                            <option value="{{$item->district_id}}">{{$item->district_name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('alumnies/index')}}" class="btn btn-default">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection