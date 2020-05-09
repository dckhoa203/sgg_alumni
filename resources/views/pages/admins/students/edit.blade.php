@extends('layouts.admin')
@section('content')
<div class="row">
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
            </div>
        @endif
    <div class="col-sm-11">
        <form action="{{route('students.update',$user_id)}}" method="POST">
            @csrf
            <div class="white-box">
                <h2 class="text-center text-primary">Chỉnh sửa thông tin sinh viên</h2>
                <br>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center align-middle"><p class="text-primary">Thông tin sinh viên</p></th>
                        <th colspan="2" class="text-center align-middle"><p class="text-primary">Thông tin lớp học</p></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-right align-middle">Mã số sinh viên</th>
                        <th><input class="form-control" type="text" name="code" id="code" placeholder="{{strtoupper($user->code)}}" readonly></th>
                        <th class="text-right align-middle">Mã lớp</th>
                    <th><input class="form-control" type="text" name="class_code" id="class_code" placeholder="{{strtoupper($academy->academy_code)}}{{strtoupper($major->major_code)}}{{strtoupper($class->class_code)}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Tên sinh viên</th>
                        <th><input class="form-control" type="text" name="name" id="name" placeholder="{{$user->name}}" readonly></th>
                        <th class="text-right align-middle">Tên lớp</th>
                    <th><input class="form-control" type="text" name="class_name" id="class_name" placeholder="{{$class->class_name}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Giới tính</th>
                        {{-- <th><input class="form-control" type="text" name="gender" id="gender" placeholder="{{$user->gender}}" readonly></th>                         --}}
                        <th>
                            <select name="gender" id="gender" class="form-control" disabled>
                            <option value='' @if($user->gender=='') selected   @endif>Nam</option>
                            <option value='N'@if($user->gender=='N') selected  @endif>Nữ</option>
                            </select>
                        </th>
                        <th class="text-right align-middle">Khóa</th>
                        <th><input class="form-control" type="text" name="course" id="course" placeholder="{{$user->course}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Dân tộc</th>
                        <th><input class="form-control" type="text" name="nation" id="nation" placeholder="{{$user->nation}}" readonly></th>
                        <th class="text-right align-middle">Mã chuyên ngành</th>
                        @if($majorbranch==null) 
                                    <th><input class="form-control" type="text" placeholder="" readonly></th>
                                @else
                                <th><input class="form-control" type="text" placeholder="{{$majorbranch->major_branch_code}}" readonly></th>
                                @endif
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Ngày sinh</th>
                        <th><input class="form-control" type="text" name="birth" id="birth" placeholder="{{$user->birth}}" readonly></th>
                        <th class="text-right align-middle">Tên chuyên ngành</th>
                        @if($majorbranch==null) 
                                    <th><input class="form-control" type="text" placeholder="" readonly></th>
                                @else
                                <th><input class="form-control" type="text" placeholder="{{$majorbranch->major_branch_name}}" readonly></th>
                                @endif
                    </tr>   
                    <tr>
                        <th class="text-right align-middle">Email</th>
                        <th><input class="form-control" type="text" name="email" id="email" placeholder="" value="{{$user->email}}"></th>
                        <th class="text-right align-middle">Mã ngành</th>
                        <th><input class="form-control" type="text" name="major_code" id="major_code" placeholder="{{strtoupper($major->major_code)}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">SĐT gia đình</th>
                        <th><input class="form-control" type="text" name="family_tel" id="family_tel" placeholder="" value="{{$user->family_tel}}"></th>
                        <th class="text-right align-middle">Tên ngành</th>
                        <th><input class="form-control" type="text" name="major_name" id="major_name" placeholder="{{$major->major_name}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">SĐT cá nhân</th>
                        <th><input class="form-control" type="text" name="tel" id="tel" placeholder="" value="{{$user->tel}}"></th>  
                        <th class="text-right align-middle">Mã khoa</th>
                        <th><input class="form-control" type="text" name="academy_code" id="academy_code" placeholder="{{strtoupper($academy->academy_code)}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Địa chỉ gia đình</th>
                        <th><input class="form-control" type="text" name="family_address" id="family_address" placeholder="" value="{{$user->family_address}}"></th>
                        <th class="text-right align-middle">Tên khoa</th>
                        <th><input class="form-control" type="text" name="academy_name" id="academy_name" placeholder="{{$academy->academy_name}}" readonly></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Địa chỉ liên hệ</th>
                        <th><input class="form-control" type="text" name="address" id="address" placeholder="" value="{{$user->address}}"></th> 
                        <th colspan="2" class="text-center  align-middle"><p class="text-primary">Trạng thái sinh viên</p></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Công việc hiện tại</th>
                        <th><input class="form-control" type="text" name="" id="" placeholder="" readonly></th>
                        <th class="text-right align-middle">Tình trạng</th>
                        <th><input class="form-control" type="text" name="status" id="status" placeholder="" value="{{$user->status}}"></th>
                    </tr>
                    <tr>
                        <th class="text-right align-middle">Công ty hiện tại</th>
                        <th><input class="form-control" type="text" name="" id="" placeholder="" readonly></th>
                            
                        <th class="text-right align-middle">Lý do</th>
                        <th><input class="form-control" type="text" name="reason" id="reason" placeholder="" value="{{$user->reason}}"></th>
                    </tr> 
                </tbody>
            </table>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('students.index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
</div>
    
@endsection