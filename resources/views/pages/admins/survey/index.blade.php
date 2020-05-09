
@extends('layouts.admin')
@section('content')
<div id="page-wrapper">
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div class="alert alert-danger  " role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                    <div class="white-box">
                    <h3 class="box-title">Khảo sát</h3>
                    <br>
                    @if (Auth::user()->hasRole('Manager') || Auth::user()->hasRole('Admin'))
                        <a  style="width:80px" href="{{route('survey.create_render')}}" class="btn btn-success waves-effect waves-light m-r-10">Thêm</a>    
                    @endif
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="table_students" class="table table-striped dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Phiên bản</th>
                                    <th>Tên khảo sát</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Người tạo</th>
                                    <th>Mã người tạo</th>
                                    <th>Chức năng                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($survey as $item)
                                    <tr>
                                        <td>{{$item->survey_version}}</td>
                                        <td>{{$item->survey_name}}</td>
                                        <td>{{date('d-m-Y h:i:s', strtotime($item->survey_start))}}</td>
                                        <td>{{date('d-m-Y h:i:s', strtotime($item->survey_end))}}</td>
                                        <td>{{$item->users['name']}}</td>
                                        <td>{{$item->users['username']}}</td>
                                        <td colspan="4">
                                            {{-- @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager')) --}}
                                                <form action="{{ route('survey/destroy', $item->survey_id) }}" method="post" class="delete_form">
                                                <a href='{{route('survey.view',$item->survey_id)}}' data-toggle="tooltip"data-placement="top" title="Thực hiện khảo sát"><i class="fas fa-tasks fa-lg"></i></a>
                                                <a href="{{route('survey.detail',$item->survey_id)}}" data-toggle="tooltip" data-placement="top" title="Cập nhật câu hỏi"><i class="fas fa-plus fa-lg"></i></a>
                                                <a href="{{route('view.survey.answers',$item->survey_id)}}"data-toggle="tooltip" data-placement="top" title="Xem câu trả lời"><i class="far fa-clipboard  fa-lg"></i></a>
                                                <a href="{{ action('Master\SurveyController@edit',$item->survey_id) }}" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-pencil m-r-10 fa-lg"></i></a>
                                                
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fal fa-trash-alt fa-lg"></i></button>
                                            </form>
                                            {{-- @else
                                                <a href='{{route('survey.view',$item->survey_id)}}' data-toggle="tooltip"data-placement="top" title="Thực hiện khảo sát"><i class="fas fa-tasks fa-lg"></i></a>
                                            @endif --}}
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>{{-- end div white-box --}}
            </div>
           {{-- end col-sm-12 --}}
        </div> 
        {{-- end div row --}}
    </div>
    {{-- end div container-fluid --}}
</div>
{{-- end div page-wrapper --}}
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        
    });
    $(document).ready(function () {
        $('#table_students').DataTable({
                dom: 'Bfrtip',
                buttons: [
                ]
            }); 
    });
    $(document).ready(function () {
        $('.delete_form').on('submit',function(){
            if(confirm('Bạn muốn xóa khảo sát này?'))
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
@endsection
@section('script')
<script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    $(function () 
        $('[data-toggle="tooltip"]').tooltip();
    )
</script>
@endsection