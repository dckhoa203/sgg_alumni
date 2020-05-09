@extends('layouts.admin')
@section('content')
<div id="page-wrapper">
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
    <div class="container-fluid">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12">
                        <h3 class="box-title">Chuyên ngành</h3>
                        <br>
                        @if (Auth::user()->hasRole('Admin'))
                            <a style="width:80px" href="{{route('major_branch/create')}}" class="btn btn-success waves-effect waves-light m-r-10">Thêm</a>    
                        @endif
                        <br>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>ID chuyên ngành:</th>
                                        <th>Mã chuyên ngành:</th>
                                        <th>Tên chuyên ngành:</th>
                                        @if (Auth::user()->hasRole('Admin'))
                                            <th>Chức năng:</th>    
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item['major_branch_id']}}</td>
                                            @foreach($major_name as $name)
                                                @if ( $name->major_id == $item['major_id'] )
                                                    <td>{{$name->major_name}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{$item['major_branch_name']}}</td>
                                            @if (Auth::user()->hasRole('Admin'))
                                                <td>
                                                    <form action="{{ route('major_branch/destroy', $item->major_id) }}" method="post" class="delete_form">
                                                        <a href="{{ action('Master\MajorBranchController@edit',$item->major_branch_id) }}"data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fal fa-trash-alt"></i></button>

                                                    </form>
                                                </td>
                                            @endif
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                {{-- end div col-sm-6 --}}
            </div> 
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
        $('.delete_form').on('submit',function(){
            if(confirm('Bạn có muốn xóa chuyên nghành này không?'))
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
);
</script>
@endsection