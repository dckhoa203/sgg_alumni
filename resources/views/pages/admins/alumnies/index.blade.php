@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <p>{{$message}}</p>
                    <p class="mb-0"></p>
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Upload Validation Error
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            <br>
            @if (Auth::user()->hasRole('Admin'))
                <a href="{{route('alumnies/create')}}" class="btn btn-success">Thêm</a>    
                
                <br>
                <div class="div" align="right">
                    {{-- <form name="import_alumnies" action="{{ route('alumnies/import') }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return ImportAlumni()">
                        @csrf
                        <input type="file" name="file" accept=".xlsx">
                        <button type="submit" class="btn btn-warning">Import</button>
                    </form> --}}
                    <form name="import_graduate" action="{{route('alumnies/import_register_graduate')}}" method="post" enctype="multipart/form-data"
                    onsubmit="return ImportGraduate()">
                        @csrf
                        <input type="file" name="file_graduate" id="file_graduate">
                        <button type="submit" class="btn btn-danger">Import Graduate</button>
                        <span class="text-muted">.xlsx, .csv, .xls</span>
                    </form> 
                </div>
            @endif
            <div class="table-responsive">
                <table id="table_students" class="table display">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>MSSV</th>
                            <th>Khóa</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Lý do</th>
                            @if (Auth::user()->hasRole('Admin'))
                                <th>Chức năng &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>    
                            @else
                                <th></th>
                            @endif
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td>{{$row->user_id}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->course}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->tel}}</td>
                                <td><a href="mailto:{{$row->email}}">{{$row->email}}</a></td>
                                @if ($row->gender === 'N' || $row->gender === 'Nữ' || $row->gender === 'Nu' || $row->gender === 'nữ')
                                    <td>Nữ</td>
                                @else
                                    <td>Nam</td>
                                @endif
                                <td>{{$row->birth}}</td>
                                <td>{{$row->address}}</td>
                                <td>
                                        {{$row->status_name}}
                                </td>
                                <td>
                                        {{$row->status_reason}}
                                </td>
                                @if (Auth::user()->hasRole('Admin'))
                                    <td>
                                        <form action="{{ route('alumnies/destroy', $row->user_id) }}" method="post" class="delete_form">
                                                
                                            <a href="{{route('alumnies/show',$row->user_id)}}" data-toggle="tooltip"  data-original-title="Show"><i class="icon-user fa-lg"></i></a>
                                            <a href="{{route('alumnies/edit',$row->user_id)}}" data-toggle="tooltip"  data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10 fa-lg"></i></a>
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip"  title="Delete"><i class="fal fa-trash-alt fa-lg"></i></button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        
                                    </td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#table_students').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            }); 
    });
    function ImportAlumni()
    {
        var x = document.forms["import_alumnies"]["file"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import");
            return false;
        }
    }
    function ImportGraduate()
    {
        var x = document.forms["import_graduate"]["file_graduate"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import");
            return false;
        }
    }
</script>
<script>
    $('.delete_form').on('submit',function(){
            if(confirm('Bạn có muốn xóa sinh viên này?'))
            {
                return true;
            }
            else
            {
                return false;
            }
    });
    
</script>
    
@endsection
@section('script')
<script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
$(function () 
    $('[data-toggle="tooltip"]').tooltip();
);
</script>
@endsection