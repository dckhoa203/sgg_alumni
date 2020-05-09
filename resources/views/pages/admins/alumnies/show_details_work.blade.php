@extends('layouts.admin')
@section('content')
        <div class="white-box">
            <h2>Lịch sử công việc</h2>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>MSSV</th>
                        <th>Họ và tên</th>
                        {{-- <th>ID Công việc</th> --}}
                        <th>Chuyên môn công việc</th>
                        <th>Mức lương</th>
                        <th>Tên công ty</th>
                        <th>Địa chỉ công ty</th>
                        <th>Ngày vào làm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($work_user as $item)
                        <tr>
                            <td>{{$item->code}}</td>
                            <td>{{$item->name}}</td>
                            {{-- <td>{{$item->work_id}}</td> --}}
                            @if (isset($item->work_specialize))
                                <td>{{$item->work_specialize}}</td>
                            @else
                                <td>{{$item->work_name}}</td>
                            @endif
                            <td>{{$item->work_salary}}</td>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->company_address}}</td>
                            <td>{{$item->work_begin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <a href="{{route('alumnies/index')}}" class="btn btn-default">Back</a>
        </div>
@endsection