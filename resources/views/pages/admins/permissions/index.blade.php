@extends('layouts.admin')
@section('content')
<!--row -->
<div class="row">
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
        <div class="col-lg-12 col-sm-6 col-xs-12">
            <div class="white-box">
                <a href="{{route('permissions/advance')}}" class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-bolt"></i></span>Nâng cao</a>
                <a href="{{route('permission/personal_route')}}" class="btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-bolt"></i></span>Cá nhân</a>
            </div>
        </div>
    @foreach ($roles as $row)
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="white-box">
                <h3 class="m-b-0 box-title">{{$row->role_name}}</h3>
                <p class="text-muted m-b-30">Thực hiện thêm và xem các đường dẫn có thể truy cập của các phân quyền</p>
                <div class="button-box">
                    <a href="{{route('permissions/create',$row->role_id)}}" class="btn btn-success">Thêm routes <i class="ti-settings"></i></a>
                    <a href="{{route('permissions/show',$row->role_id)}}" class="btn btn-primary">Xem routes <i class="ti-new-window"></i></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!--row -->
@endsection