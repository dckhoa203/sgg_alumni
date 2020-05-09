@extends('layouts.admin')
@section('content')
<!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{$message}}</p>
                    <p class="mb-0"></p>
                </div>
                @endif
                <h3 class="box-title m-b-0">HỌ VÀ TÊN
                    @foreach ($role_user as $row)
                        {{$row->name}} - {{$row->username}}
                        Vai trò 
                        @foreach ($row->roles as $item)
                            {{$item->role_name}}
                        @endforeach
                    @endforeach
                </h3>
                <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-6 text-right m-b-20">
                                <div class="form-group">
                                    {{-- @foreach ($roles as $row)
                                        <a href="{{route('permissions/create',$row->role_id)}}" class="btn btn-default">Back</a>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                    <thead>
                        <tr>
                            <th data-sort-initial="true" data-toggle="true">STT</th>
                            <th data-hide="phone, tablet">Route link</th>
                            <th data-hide="phone, tablet">Route name</th>
                            <th data-hide="phone, tablet">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permission as $row)
                            <tr>
                                <td>{{$row->permission_user_id}}</td>
                        
                                @foreach ($row->route as $item)
                                    <td>{{$item->route_link}}</td>
                                    <td>{{$item->route_name}}</td>
                                    
                                @endforeach
                                <td>
                                    <form action="{{ route('permissions/remove_personal_route', $row->permission_user_id) }}" method="post" class="delete_form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete">DELETE</button>
                                    </form>
                                </td>
                            </tr>  
                        @endforeach

                </table>

               
            </div>
        </div>
    </div>
    <!-- /.row -->
    
    <script>
        $(document).ready(function () {
            $('#demo-foo-addrow').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                }); 
        });
        $(document).ready(function () {
            $('.delete_form').on('submit',function(){
                if(confirm('Are you sure delete id??'))
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