@extends('layouts.admin')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <p>{{$message}}</p>
                    <p class="mb-0"></p>
                </div>
                @endif
            <div class="col-sm-12">
                <div class="white-box">
                    <h2 class="text-center text-primary">Thông tin sinh viên</h2>
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
                            <th><input class="form-control" type="text" placeholder="{{strtoupper($user->username)}}" readonly></th>
                                <th class="text-right align-middle">Mã lớp</th>
                            <th><input class="form-control" type="text" placeholder="{{strtoupper($class->class_code)}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Tên sinh viên</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->name}}" readonly></th>
                                <th class="text-right align-middle">Tên lớp</th>
                            <th><input class="form-control" type="text" placeholder="{{$class->class_name}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Giới tính</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->gender}}" readonly></th>                        
                                <th class="text-right align-middle">Khóa</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->course}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Dân tộc</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->nation}}" readonly></th>
                                <th class="text-right align-middle">Mã chuyên ngành</th>
                                @if($majorbranch==null) 
                                    <th><input class="form-control" type="text" placeholder="" readonly></th>
                                @else
                                <th><input class="form-control" type="text" placeholder="{{$majorbranch->major_branch_code}}" readonly></th>
                                @endif
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Ngày sinh</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->birth}}" readonly></th>
                                <th class="text-right align-middle">Tên chuyên ngành</th>
                                @if($majorbranch==null) 
                                    <th><input class="form-control" type="text" placeholder="" readonly></th>
                                @else
                                <th><input class="form-control" type="text" placeholder="{{$majorbranch->major_branch_name}}" readonly></th>
                                @endif
                            </tr>   
                            <tr>
                                <th class="text-right align-middle">Email</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->email}}" readonly></th>
                                <th class="text-right align-middle">Mã ngành</th>
                                <th><input class="form-control" type="text" placeholder="{{strtoupper($major->major_code)}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">SĐT gia đình</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->family_tel}}" readonly></th>
                                <th class="text-right align-middle">Tên ngành</th>
                                <th><input class="form-control" type="text" placeholder="{{$major['major_name']}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">SĐT cá nhân</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->tel}}" readonly></th>  
                                <th class="text-right align-middle">Mã khoa</th>
                                <th><input class="form-control" type="text" placeholder="{{strtoupper($academy->academy_code)}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Địa chỉ gia đình</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->family_address}}" readonly></th>
                                <th class="text-right align-middle">Tên khoa</th>
                                <th><input class="form-control" type="text" placeholder="{{$academy->academy_name}}" readonly></th>
                            </tr>
                            <tr>
                                <th class="text-right align-middle">Địa chỉ liên hệ</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->address}}" readonly></th> 
                                <th colspan="2" class="text-center  align-middle"><p class="text-primary">Trạng thái sinh viên</p></th>
                            </tr>
                            @foreach ($user->statuses as $item)
                            <tr>
                                <th class="text-right align-middle">Công việc hiện tại</th>
                                <th><input class="form-control" type="text" placeholder="" readonly></th>
                                <th class="text-right align-middle">Tình trạng</th>
                                <th><input class="form-control" type="text" placeholder="{{$user->statuses[0]['status_name']}}" readonly></th>
                            </tr>
                            @endforeach
                            @foreach ($user->statuses as $item)
                            <tr>
                                <th class="text-right align-middle">Công ty hiện tại</th>
                                <th class=" align-middle"><input class="form-control" type="text" placeholder="" readonly></th>
                                    
                                <th class="text-right align-middle">Lý do</th>
                                {{-- @if($user->statuses[0]['status_reason'] != null) --}}
                                    <th class="align-middle"><input class="form-control" type="text" placeholder="{{$user->statuses[0]['status_reason']}}" readonly></th>
                                {{-- @else  --}}
                                    {{-- <th class="align-middle"><input class="form-control" type="text" placeholder="" readonly></th> --}}
                                {{-- @endif --}}
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group" align="right">
                        <a href="{{route('students.index')}}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_form').on('submit',function(){
            if(confirm('Are you sure delete id??'))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#table_pagination').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url : "{{route('students.index')}}",
            },
            columns: [
                {
                    data: code,
                    name: code,
                },
                {
                    data: first_name,
                    name: first_name,
                },
                {
                    data: last_name,
                    name: last_name,
                },
                {
                    data: username,
                    name: username,
                },
                {
                    data: password,
                    name: password,
                },
                {
                    data: tel,
                    name: tel,
                },
                {
                    data: email,
                    name: email,
                },
                {
                    data: active_code,
                    name: active_code,
                },
                {
                    data: gender,
                    name: gender,
                },
                {
                    data: birthday,
                    name: birthday,
                },

            ]

        });
        
    });
</script>

@endsection