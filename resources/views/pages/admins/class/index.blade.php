@extends('layouts.admin')
@section('content')
    <div class="row">
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
        <div class="col-sm-12">
            <div class="white-box">
                    <form name="import_class" action="{{route('class/import')}}" method="post" enctype="multipart/form-data"
                    onsubmit="return ImportClass()">
                                @csrf
                                <div style="float:right">
                                <input type="file" name="import_classes" id="import_classes">
                                <button type="submit" class="btn btn-danger">Import Cố vấn học tập</button>
                                    <span class="text-muted">.xlsx, .csv, .xls</span>
                                </div>
                    </form> 
                <table id="myTable" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                        <br>
                        @if (Auth::user()->hasRole('Admin'))
                        
                            <a style="width:100" href="{{route('class/create')}}" class="btn btn-success">Tạo lớp</a> &nbsp;
                            <a style="width:100" href="{{route('class/create_quick')}}" class="btn btn-primary ">Tạo Nhanh</a>
                            
                        @endif
                        <br>
                        <br>
                        <thead>
                                {{-- <tr role="row"> --}}
                            {{-- <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Code: activate to sort column descending" style="width: 104px;"></th> --}}
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Class ID: activate to sort column ascending" style="width: 20px">ID</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Class Code: activate to sort column ascending" style="width: 100px;">Mã lớp</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Major: activate to sort column ascending" style="width: 400px;">Ngành</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Major Branch: activate to sort column ascending" style="width: 100px;">Chuyên nghành</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Class Name: activate to sort column ascending" style="width: 300px;">Tên lớp</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="Class Name: activate to sort column ascending" style="width: 300px;">Cố vấn</th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="School Year Begin: activate to sort column ascending" style="width: 100px">Năm bắt đầu</th> --}}
                                {{-- <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-label="School Year End: activate to sort column ascending" style="width: 100px">Học kỳ bắt đầu</th> --}}
                                @if (Auth::user()->hasRole('Admin'))
                                    <th rowspan="1" colspan="1"  style="width: 100px">Chức năng</th>
                                @else
                                    <th></th>
                                @endif
                                
                            {{-- </tr> --}}
                        </thead>
                        <tbody>
                            @foreach ($class as $item)
                                    <tr>
                                        <td>{{$item->class_id}}</td>
                                        <td>{{$item->class_code}}</td>
                                        <td>{{$item->major_name}}</td>
                                            @foreach($major_branch as $name)
                                                @if ( $name->major_branch_id == $item->major_branch_id )
                                                    <td>{{$name->major_branch_name}}</td>
                                                @else <td> &nbsp;</td>
                                                @endif
                                            @endforeach
                                    
                                        <td>{{$item->class_name}}</td>
                                       <td>
                                            @if(isset($classuser[$item->class_code]))
                                                @foreach($classuser[$item->class_code] as $value)
                                                    {{$value->code}} - {{$value->name}}<br>
                                                @endforeach
                                            @else <td> &nbsp;</td>
                                            @endif
                                        </td>
                                        @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager') || Auth::user()->hasRole('Teacher'))
                                            <td>
                                                <form action="{{ route('class/destroy', $item->class_id) }}" method="post" class="delete_form">
                                                    @csrf
                                                    <a href="{{route('class/show', $item->class_id) }}"  data-toggle="tooltip" data-placement="top" title="Xem thông tin lớp">&nbsp;&nbsp;<i class="icon-user"></i></a>
                                                    <a href="{{route('class/edit', $item->class_id) }}" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                    <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fal fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
            $('.delete_form').on('submit',function(){
                if(confirm('Bạn có muốn xóa lớp học này không?'))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });
        });
        $(document).ready(function() {
            $('#myTable').DataTable();
            
        });
</script>
@endsection
@section('script')
    <script type="text/javascript">
        

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        $(function () 
            $('[data-toggle="tooltip"]').tooltip();
        );
    </script>
    <script>
    function ImportClass()
    {
        var x = document.forms["import_class"]["file"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import !!");
            return false;
        }
    }
    </script>

@endsection