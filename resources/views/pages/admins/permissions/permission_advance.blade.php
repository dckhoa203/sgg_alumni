@extends('layouts.admin')

@section('content')
    <!-- .row -->
    <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">PHÂN QUYỀN NÂNG CAO CHO ADMIN</h3>
                    <p class="text-muted m-b-20">Thực hiện thêm một phân quyền trực tiếp</p>
                    <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7">
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
                                    <td><span class="label label-table label-info">
                                        @foreach ($row->roles as $item)
                                            {{$item->role_name}}
                                        @endforeach  
                                    </span> </td>
                                    <td>
                                        @if ($row->user_id != Auth::user()->user_id)
                                            {{-- TODO: ADMIN  --}}
                                            @if ($row->hasRole('Admin'))
                                                <a href="{{route('permissions/remove_admin',$row->user_id)}}" class="btn btn-danger">Remove Admin</a>
                                            @else
                                                <a href="{{route('permissions/give_admin',$row->user_id)}}" class="btn btn-warning">Give Admin</a>
                                            @endif
                                            {{-- TODO: MANAGER ACADEMIES --}}
                                            @if ($row->hasRole('Manager'))
                                                <a href="{{route('permissions/remove_manager',$row->user_id)}}" class="btn btn-danger">Remove Manager</a>
                                            @else
                                                <a href="{{route('permissions/give_manager',$row->user_id)}}" class="btn btn-facebook">Give Manager</a>
                                            @endif
                                            {{-- TODO: TEACHER --}}
                                            @if ($row->hasRole('Teacher'))
                                                <a href="{{route('permissions/remove_teacher',$row->user_id)}}" class="btn btn-danger">Remove Teacher</a>
                                            @else
                                                <a href="{{route('permissions/give_teacher',$row->user_id)}}" class="btn btn-info">Give Teacher</a>
                                            @endif
                                            {{-- TODO: ALUMNI --}}
                                            @if ($row->hasRole('Alumni'))
                                                <a href="{{route('permissions/remove_alumni',$row->user_id)}}" class="btn btn-danger">Remove Alumni</a>
                                            @else
                                                <a href="{{route('permissions/give_alumni',$row->user_id)}}" class="btn btn-success">Give Alumni</a>
                                            @endif
                                            {{-- TODO: STUDENT --}}
                                            @if ($row->hasRole('Student'))
                                                <a href="{{route('permissions/remove_student',$row->user_id)}}" class="btn btn-danger">Remove Student</a>
                                            @else
                                                <a href="{{route('permissions/give_student',$row->user_id)}}" class="btn btn-primary">Give Student</a>
                                            @endif
                                        @endif
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