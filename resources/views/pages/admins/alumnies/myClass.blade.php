@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <h2 class="card-title">Danh sách lớp của tôi</h2>
                <h3 class="card-subtitle">
                    @foreach ($classes as $item)
                    Khóa: {{$item->year - 1974}} - Lớp: {{$item->class_name}} <br>
                    @endforeach
                </h3>
                <div class="table-responsive">
                    <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                        <thead>
                            <tr>
                                <th>MSSV</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày sinh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_users as $row)
                                <tr>
                                <td>{{$row->username}}</td>
                                    <td>    
                                        @if ($row->gender == "N" || $row->gender == "Nữ")   {{--Nữ  --}}
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user" width="40" class="img-circle" /> {{$row->name}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)">
                                                <img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user" width="40" class="img-circle" /> {{$row->name}}
                                            </a>
                                        @endif
                                        
                                    </td>
                                    <td><a href="mailto:{{$row->email}}" target="_top">{{$row->email}}</a></td>
                                    <td><a href="tel:{{$row->tel}}">{{$row->tel}}</a></td>
                                    <td>{{$row->address}}</td>
                                    <td>{{$row->birth}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection