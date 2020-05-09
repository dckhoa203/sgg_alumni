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
                    <h2 class="text-center text-primary">Thông tin giáo viên</h2>
                    <br>
                    <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center align-middle"><p class="text-primary">Thông tin giáo viên</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-right align-middle">Mã giáo viên</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->username}}" readonly></th>
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">Tên giáo viên</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->name}}" readonly></th>
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">Giới tính</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->gender}}" readonly></th>                        
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">Dân tộc</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->nation}}" readonly></th>
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">Ngày sinh</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->birth}}" readonly></th>
                                </tr>   
                                <tr>
                                    <th class="text-right align-middle">Email</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->email}}" readonly></th>
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">SĐT</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->tel}}" readonly></th> 
                                </tr>
                                <tr>
                                    <th class="text-right align-middle">Địa chỉ</th>
                                    <th><input class="form-control" type="text" placeholder="{{$teacher->address}}" readonly></th> 
                                </tr> 
                            </tbody>
                        </table>   
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-sm">

                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center align-middle"><p class="text-primary">Thông tin lớp cố vấn</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($teacher->classes)
                                    <td><strong>Năm:</strong></td>
                                    <td><strong>Lớp cố vấn:</strong></td>
                                    @endif
                                </tr>
                                
                                    @forelse($teacher->classes as $teach)
                                    <tr>
                                        <td>{{substr($teach->class_begin, 0, 4)}}-{{substr($teach->class_end, 0, 4)}}</td>
                                        <td>{{$teach->class_code}} - {{$teach->class_name}} - K{{(int)substr($teach->class_begin, 0, 4)-1974}}</td>
                                    @empty
                                    <td></td>
                                </tr>
                                    @endforelse
                                
                            </tbody>
                        </table>   
                    </div>
                    </div>
                    <div class="form-group" align="right">
                        <a href="{{route('teacher.index')}}" class="btn btn-default">Back</a>
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
                url : "{{route('teacher.index')}}",
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