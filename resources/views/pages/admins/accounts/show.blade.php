@extends('layouts.admin')

@section('content')
<div class="white-box">
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p>{{$message}}</p>
        <p class="mb-0"></p>
    </div>
    @endif
    <h2>Lịch sử công việc</h2>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Chuyên môn công việc</th>
                <th>Mức lương</th>
                <th>Tên công ty</th>
                <th>Địa chỉ công ty</th>
                <th>Ngày bất đầu làm việc</th>
                <th>Ngày nghỉ việc</th>
                <th>Trạng thái công việc</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($works as $item)
            @if (Auth::user()->user_id == $item->user_id)
                <tr>
                    <td>{{$item->work_id}}</td>
                    @if (isset($item->work_specialize))
                        <td>{{$item->work_specialize}}</td>
                    @else
                        <td>{{$item->work_name}}</td>
                    @endif
                    <td>{{$item->work_salary}}</td>
                    <td>{{$item->company_name}}</td>
                    <td>{{$item->company_address}}</td>
                    <td>{{date('d-m-Y', strtotime($item->work_begin))}}</td>
                    @if (isset($item->work_end))
                        <td>{{date('d-m-Y', strtotime($item->work_end))}}</td>
                    @else
                        <td>Bạn chưa nghỉ việc</td>
                    @endif
                    @if ($item->work_status === 'resigned')
                        <td>Nghỉ việc</td>
                    @else
                        <td>Đang làm việc</td>
                    @endif
                </tr>
            @endif
                
            @endforeach
        </tbody>
    </table>
    <a href="{{route('accounts/jobs')}}" class="btn btn-default">Back</a>
</div>
@endsection