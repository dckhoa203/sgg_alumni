@extends('layouts.admin')
@section('content')
    <div class="row">
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
        <div class="col-sm-12">
            <div class="white-box">
                @foreach($teacher as $value)
                <h3>{{$value->username}} - {{$value->name}}</h3><br>
                @endforeach
                <h4>{{$class->class_code}} - {{$class->class_name}}</h4>

                <div class="form-group" align="right">
                    <a href="{{route('mails.send_class',$class->class_id)}}" class="btn btn-twitter">Gửi Email</a>
                    <a href="{{url('posts/post_only_class',$class->class_id)}}" class="btn btn-primary">Đăng bài</a>
                </div>
                <table id="myTable" class="table table-striped dataTable no-footer" role="grid" aria-describedby="myTable_info">
                        <br>
                        <br>
                        <br>
                        <thead>
                            {{-- <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Code: activate to sort column descending" style="width: 104px;"></th> --}}
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 20px">ID</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 100px;">MSSV</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">Tên</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">Ngày sinh</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">Giới tinh</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">SDT</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 400px;">Địa chỉ</th>

                                
                                
                                @if (Auth::user()->hasRole('Admin'))
                                    <th rowspan="1" colspan="1"  style="width: 100px">Chức năng</th>
                                @else
                                    <th></th>
                                @endif
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $value)
                                <tr>
                                    <td>{{$value->user_id}}</td>
                                    <td>{{$value->username}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->birth}}</td>
                                    <td>{{$value->gender}}</td>
                                    <td>{{$value->tel}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->address}}</td>

                                    @if (Auth::user()->hasRole('Admin'))
                                    <td>
                                    {{-- <form action="{{ route('class/destroy', $item->class_id) }}" method="post" class="delete_form"> --}}
                                        @csrf
                                        {{-- <a href="{{route('class/show', $item->class_id) }}"  data-toggle="tooltip" data-placement="top" title="Xem thông tin lớp">&nbsp;&nbsp;<i class="icon-user"></i></a>
                                        <a href="{{route('class/edit', $item->class_id) }}" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-pencil text-inverse m-r-10"></i></a> --}}
                                        {{-- <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fal fa-trash-alt"></i></button> --}}

                                    {{-- </form> --}}
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

@endsection