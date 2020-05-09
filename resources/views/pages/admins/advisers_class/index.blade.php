@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Thông tin lớp cố vấn</h3>
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>MÃ LỚP</th>
                                        <th>KHÓA</th>
                                        <th>TÊN LỚP</th>
                                        <th>TÊN NGHÀNH</th>
                                        <th>NĂM BẤT ĐẦU</th>
                                        <th>NĂM KẾT THÚC</th>
                                        <th>CHỨC NĂNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_class as $row)
                                        
                                        <tr>
                                            <td>{{$row->class_id}}</td>
                                            <td>{{$row->class_code}}</td>
                                            <td>
                                                {{$row->year - 1974}}
                                            </td>
                                            <td>{{$row->class_name}}</td>
                                            <td>{{$row->major_name}}</td>
                                            <td>{{$row->class_begin}}</td>
                                            <td>{{$row->class_end}}</td>
                                            <td>
                                                <a href="{{url('posts/post_only_class',$row->class_id)}}" class="btn btn-primary">Đăng bài</a>
                                                <a href="{{route('mails.send_class',$row->class_id)}}" class="btn btn-twitter">Gửi mail</a>
                                            </td>
                                        </tr>

                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            
        });
        </script>
@endsection