@extends('layouts.admin')
@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">THÊM ROUTE ƯU TIÊN CHO NGƯỜI DÙNG CHỈ ĐỊNH</h3>
                <p class="text-muted m-b-20">Thêm đường dẫn cho người dùng nào bạn muốn</p>
                <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-sort-initial="true" data-toggle="true">STT</th>
                            <th data-hide="phone, tablet">MÃ SỐ</th>
                            <th data-hide="phone, tablet">HỌ VÀ TÊN</th>
                            <th data-hide="phone, tablet">TÊN QUYỀN</th>
                            <th data-sort-ignore="true" class="min-width">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_role as $row)
                            <tr>
                                <td>{{$row->user_id}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->name}}</td> 
                                {{-- @foreach ($row->roles as $item)
                                        @switch($item->role_name)
                                            @case('Admin')
                                                <td><span class="label label-table label-danger">{{$item->role_name}}</span> </td>
                                            @break

                                            @case('Manager')
                                                <td><span class="label label-table label-warning">{{$item->role_name}}</span> </td>
                                            @break

                                            @case('Teacher')
                                                <td><span class="label label-table label-info">{{$item->role_name}}</span> </td>
                                            @break

                                            @case('Alumni')
                                                <td><span class="label label-table label-primary">{{$item->role_name}}</span> </td>
                                            @break

                                            @default
                                            <td><span class="label label-table label-success">{{$item->role_name}}</span> </td>
                                        @endswitch   --}}
                                        <td><span class="label label-table label-info">
                                            @foreach ($row->roles as $item)
                                                {{$item->role_name}}
                                            @endforeach  
                                        </span> </td> 
                                {{-- @endforeach   --}}
                                
                                <td>
                                    <a href="{{route('permissions/add_personal_route',$row->user_id)}}" class="btn btn-success">Thêm route ưu tiên</a>
                                    <a href="{{route('permissions/show_personal_route',$row->user_id)}}" class="btn btn-facebook">Xem route ưu tiên</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                    <a href="{{url('/permissions')}}" class="btn btn-default">Back</a>
                                <div class="text-right">
                                    
                                    <ul class="pagination">
                                        {!! $user_role->links() !!}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
<script>
$(document).ready(function() {
    $('#demo-foo-addrow').DataTable();
    
});
</script>
@endsection