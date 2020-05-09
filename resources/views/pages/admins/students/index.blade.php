@extends('layouts.admin')
@section('content')
<!-- Page Content -->
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
        <br>
        @if (Auth::user()->hasRole('Admin'))
            <a href="{{route('students.create')}}" class="tst4 btn btn-success">Add</a>

        <br>
        <div class="card-body" align="right">
            <form name="import_student" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return ImportStudent()">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-warning">Import</button>
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
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Mã lớp</th>
                        <th>Tên lớp</th>
                        @if (Auth::user()->hasRole('Admin'))
                            <th>Chức năng</th>
                        @else
                            <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $row)
                    {{-- {{dd($row->classes)}} --}}
                        <tr>
                            <td>{{$row->user_id}}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->tel}}</td>
                            <td>{{$row->email}}</td>
                            <td>
                                @foreach ($class_name as $item)
                                @if($item->class_id==$row->class_id)
                                    {{$item->class_code}}</td>
                                    <td>{{$item->class_name}}</td>
                                @endif
                                @endforeach
                            @if (Auth::user()->hasRole('Admin'))
                                <td>
                                    <form action="{{ route('students.destroy', $row->user_id) }}" method="post" class="delete_form">
                                            
                                        <a href="{{route('students.show',$row->user_id)}}" data-toggle="tooltip"  data-placement="top" data-original-title="Hiển thị chi tiết">&nbsp;&nbsp;<i class="icon-user fa-lg"></i></a>
                                        <a href="{{route('students.edit',$row->user_id)}}" data-toggle="tooltip"  data-placement="top" data-original-title="Chỉnh sửa"><i class="fa fa-pencil text-inverse m-r-10 fa-lg"></i></a>
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fal fa-trash-alt fa-lg"></i></button>

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
    function ImportStudent()
    {
        var x = document.forms["import_student"]["file"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import !!");
            return false;
        }
    }
</script>
<script>
    $(document).ready(function () {
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
    });
</script>
@section('script')
    

<script type="text/javascript">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    $(function () 
        $('[data-toggle="tooltip"]').tooltip();
    );
</script>
@endsection
@endsection