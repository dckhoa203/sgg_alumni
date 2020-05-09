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
        <br>
        <br>
        @if (Auth::user()->hasRole('Admin'))
            <a href="{{route('teacher.create')}}" class="tst4 btn btn-success">Add</a>

        <br>
        <br>
        <br>
        {{-- <div class="card-body" align="right">
            <form action="{{ route('teacher.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-warning">Import</button>
            </form>
        </div> --}}
        @endif
        <div class="table-responsive">
            <table id="table_teacher" class="table display">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giáo viên</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        @if (Auth::user()->hasRole('Admin'))
                            <th>Chức năng</th>
                        @else
                            <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teacher as $row)
                        <tr>
                            <td>{{$row->user_id}}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->birth}}</td>
                            <td>{{$row->tel}}</td>
                            <td>{{$row->email}}</td>
                            @if (Auth::user()->hasRole('Admin'))
                                <td>
                                    <form action="{{ route('teacher.destroy', $row->user_id) }}" method="post" class="delete_form">
                                            
                                        <a href="{{route('teacher.show',$row->user_id)}}" data-toggle="tooltip"  data-placement="top" data-original-title="Hiển thị chi tiết">&nbsp;&nbsp;&nbsp;<i class="icon-user fa-lg"></i></a>
                                        <a href="{{route('teacher.edit',$row->user_id)}}" data-toggle="tooltip"  data-placement="top" data-original-title="Chỉnh sửa"><i class="fa fa-pencil text-inverse m-r-10 fa-lg"></i></a>
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
        $('#table_teacher').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            }); 
    });
</script>
<script>
        $(document).ready(function () {
        $('.delete_form').on('submit',function(){
            if(confirm('Bạn có muốn xóa giáo viên này?'))
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