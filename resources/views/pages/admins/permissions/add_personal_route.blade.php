@extends('layouts.admin')
@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                @foreach ($infor_user as $item)
                <h3 class="box-title m-b-0">Họ và tên: {{$item->name}} - MSSV: {{$item->username}}</h3>
                <h4>Vai trò: {{$item->role_name}}</h4>
                @endforeach
                
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
                <form action="{{route('permissions/store_personal_route')}}" method="post">
                    @csrf

                    <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7" style="text-align:left;">
                        <thead>
                            <tr>
                                <th style="text-align:center;">Route ID</th>
                                <th data-hide="phone, tablet" style="text-align:center;">Route link</th>
                                <th data-hide="phone, tablet" style="text-align:center;">Route Name</th>
                                <th data-sort-ignore="true" class="min-width" style="text-align:center;">Action</th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th style="text-align:center">
                                    <div class="checkbox checkbox-info">
                                        <input id="selectAll" name="selectAll" type="checkbox">
                                        <label for="selectAll">Select All</label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routes as $row)
                                <tr>
                                    <td>{{$row->route_id}}</td>
                                    <td>{{$row->route_link}}</td>
                                    <td><b>{{$row->route_name}}</b></td>
                                    <td>
                                        <div class="checkbox checkbox-info" align="center">
                                            @foreach ($infor_user as $item)
                                                <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                            @endforeach
                                            <input type="checkbox" name="route_id[]" value="{{$row->route_id}}"> 
                                            <label for="route_id"></label>
                                        </div>
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-success">Reset</button>
                        <a href="{{route('permissions/index')}}" class="btn btn-default">Back</a>
                    </div>
                </form>
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
    </script>
    <script>
        $("#selectAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    </script>
@endsection