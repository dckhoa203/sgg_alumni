@extends('layouts.admin')
@section('content')
<div class="white-box">
    <a href="{{route('accounts/show_work_yourself')}}" class="btn btn-warning">Lịch sử công việc</a>
    <br>   
    {{-- @if (isset($works)) --}}
    
        @if (isset($work_current))
            <h2 class="text-danger" style="font-family:sans-serif">
            Bạn đang làm 
            @if (isset($work_current->work_specialize))
            {{$work_current->work_specialize}}
            @else
                @if (isset($work_current->work_name))
                    {{$work_current->work_name}}
                @else
                    Chưa xét
                @endif
            @endif tại {{$work_current->company_name}} bắt đầu làm {{date('d-m-Y', strtotime($work_current->work_begin))}} 
            @if (isset($work_current->work_end))
            ngày nghỉ việc
                {{date('d-m-Y', strtotime($work_current->work_end))}}
            @else
                
            @endif
            <a href="{{route('accounts/show_current_work_and_resign')}}">Chi tiết</a></h2>
        @else
            <h3>Chưa có công việc</h3>
        @endif
        
    {{-- @else
        @if (empty($works))
            <p>Bạn chưa có việc làm</p>
        @endif
        
    @endif --}}
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            @foreach ($accounts as $item)
                @if ($item->user_id === Auth::user()->user_id)
                    @if ($item->status_id === 3 || $item->status_id === 2)
                        <form  action="{{route('accounts/add_work_submit')}}" method="post">
                            @csrf
                            <h2>Thiết lập công việc</h2>
                            <br>
                            <div class="form-group">
                                <label for="company_id">Chọn Công ty</label>
                                <select class="form-control" name="company_id" id="company_id">
                                    <option value="">Chọn công ty</option>
                                    @foreach ($infor_company as $item)
                                        <option value="{{$item->company_id}}">{{$item->company_name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <a href="#" class="btn-accept" style="color:red">Khác</a>
                            </div>
                            <div class="show-company" style="display:none;">
                                <div class="form-group">
                                    <label for="company_name" class="control-label">Tên công ty</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Tên công ty">
                                </div> 
                                <div class="form-group">
                                    <label for="company_address" class="control-label">Địa chỉ công ty</label>
                                    <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Địa chỉ công ty">
                                </div> 
                                <div class="form-group">
                                    <label for="company_tel" class="control-label">Số điện thoại công ty</label>
                                    <input type="text" class="form-control" id="company_tel" name="company_tel" placeholder="Số điện thoại công ty">
                                </div> 
                                <div class="form-group">
                                    <label for="company_email" class="control-label">Email công ty</label>
                                    <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Email công ty">
                                </div>
                            </div> {{-- END SHOW-COMPANY --}}
                            
                            <div class="form-group">
                                <label for="work_specialize">Chuyên môn công việc</label>
                                <div class="radio radio-info">
                                    <input type="radio" name="work_specialize" id="work_specialize" value="Lập trình viên" checked>
                                    <label for="work_specialize">Lập trình viên</label>
                                </div>
                                <div class="radio radio-info">
                                    <input type="radio" name="work_specialize" id="work_specialize" value="Chuyên viên tư vấn CNTT">
                                    <label for="radio5">Chuyên viên tư vấn CNTT</label>
                                </div>
                                <div class="radio radio-info">
                                    <input type="radio" name="work_specialize" id="work_specialize" value="Giảng viên/ giáo viên CNTT">
                                    <label for="work_specialize">Giảng viên/ giáo viên CNTT</label>
                                </div>
                                <div class="radio radio-info">
                                    <input type="radio" name="work_specialize" id="work_specialize" value="Quản lý">
                                    <label for="work_specialize">Quản lý</label>
                                </div>
                            </div>
                            <a href="#" class="work-other">Khác</a>
                            <br>
                            <div class="form-group show-work" style="display:none">
                                <label for="work_name" class="control-label">Tên công việc</label>
                                <input type="text" class="form-control" id="work_name" name="work_name" placeholder="Tên công việc">
                            </div>
                            <div class="form-group">
                                <label for="work_salary">Mức lương</label>
                                <div class="form-group">
                                    <div class="radio radio-info">
                                        <input type="radio" name="work_salary" id="work_salary" value="Dưới 5 triệu" checked>
                                        <label for="work_salary">Dưới 5 triệu</label>
                                    </div>
                                    <div class="radio radio-info">
                                        <input type="radio" name="work_salary" id="work_salary" value="Từ 5 - 10 triệu">
                                        <label for="work_salary">Từ 5 - 10 triệu</label>
                                    </div>
                                    <div class="radio radio-info">
                                        <input type="radio" name="work_salary" id="work_salary" value="Trên 10 triệu đồng    ">
                                        <label for="work_salary">Trên 10 triệu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="work_begin" class="control-label">Ngày vào làm</label>
                                <input type="date" class="form-control" id="work_begin" name="work_begin" placeholder="Ngày vào làm">
                            </div>
                            <a href="#" class="nghi-lam">Nghỉ làm</a>
                            <br>
                            <div class="form-group show-nghi-lam" style="display:none;">
                                <label for="work_end" class="control-label">Ngày nghỉ làm</label>
                                <input type="date" class="form-control" id="work_end" name="work_end" placeholder="Ngày vào làm">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <input type="reset" class="btn btn-infor" value="Reset">
                            </div>
                        </form> {{-- END Id="form_work" --}}
                    @else 
                        <h2>Bạn còn đi học</h2>
                    @endif {{-- END $item->status_id == 3 || $item->status_id === 2 --}}
                @endif {{-- END $item->user_id === Auth::user()->user_id --}}

            @endforeach
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.btn-accept').click(function(event){
            event.preventDefault();
            $('.show-company').toggle("slow");
        });
        $('.nghi-lam').click(function(event){
            event.preventDefault();
            $('.show-nghi-lam').toggle("slow");
        })
        $('.work-other').click(function(event){
            event.preventDefault();
            $('.show-work').toggle("slow");
        })
    });
</script>
@endsection