@extends('layouts.admin')
@section('content')
<div class="white-box">
    <div class="table-responsive">
        <table class="table full-color-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Chuyên môn</th>
                    <th>Ngày vào</th>
                    <th>Ngày nghỉ việc</th>
                    <th>Số ngày nghỉ</th>
                    <th>Tên công ty</th>
                    <th>Địa chỉ công ty</th>
                    <th>Số điện thoại công ty</th>
                    <th>Email công ty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (isset($works))
                            <td>{{$works->work_id}}</td>
                            @if (isset($works->work_specialize))
                                <td>{{$works->work_specialize}}</td>
                            @else
                                <td>{{$works->work_name}}</td>
                            @endif
                            @if (isset($works->work_begin))
                                <td>{{date('d-m-Y', strtotime($works->work_begin))}}</td>
                            @else
                                <td><b>Bạn chưa bất đầu làm việc</b></td>
                            @endif
                            @if (isset($works->work_end))
                                <td>{{date('d-m-Y', strtotime($works->work_end))}}</td>
                            @else
                                <td><b>Bạn chưa nghỉ việc</b></td>
                            @endif
                            <td>Số ngày làm việc của bạn là là: {{$result}}</td>
                            <td>{{$works->company_name}}</td>
                            <td>{{$works->company_address}}</td>
                            <td>{{$works->company_tel}}</td>
                            <td>{{$works->company_email}}</td>
                            @if ($works->work_status == "working")
                                <td>
                                    {{-- <button class="btn btn-primary btn-resign" data-workID="{{$works->work_id}}">Resign</button> --}}
                                    <button type="button" class="btn btn-danger btn-resign" data-workID="{{$works->work_id}}" data-toggle="modal" data-target="#myModal">Nghỉ việc</button>
                                </td>
                            @else
                                <td>
                                    <a href="#" class="btn btn-danger">Đã nghỉ việc</a>
                                </td>
                            @endif
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Nghỉ việc</h4>
                                    <h3 style="color:crimson; font-family:sans-serif" id="error_date"></h3>
                                </div>
                                <div class="modal-body">
                                    <label for="work_end">Chọn ngày nghỉ việc</label>
                                    <input type="date" name="work_end" id="work_end" class="form-control work_end" placeholder="" aria-describedby="helpId">
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="ngaybd" id="ngaybd" value="{{$works->work_begin}}">
                                    <button type="submit" class="btn btn-success submit-resign">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                
                            </div>
                            </div>
                        </tr>
                    @else
                        <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <h4 class="alert-heading">NOTE</h4>
                          <p>Bạn chưa nhập công việc</p>
                          <p class="mb-0"><a href="{{route('accounts/jobs')}}">Nhập công việc</a></p>
                        </div>
                    @endif
                    
            </tbody>
        </table>
    </div>
</div>
<script>
    // script này
    $('.btn-resign').click(function(){
            const confirmResult = confirm("Bạn có chắc muốn nghỉ việc tại đây?");
            if(!confirmResult)
            {
                return false;
            }

            // TODO: Nếu thằng này bị lỗi thì sẽ ko thực thi câu lệnh ở dưới
            $('.submit-resign').click(function(){
                var workEnd = $('#work_end').val();
                console.log(typeof workEnd);
                var workBegin = $('#ngaybd').val();
                console.log(typeof workBegin);
                
                console.log('workEnd <= workBegin',workEnd <= workBegin );
                

                // return false;
            
                // Ngày làm 2019-10-15
                // Ngày nghỉ 2018-10-15

                // Cái nào có keycode lớn hơn thì lớn hơn

                if(new Date(workEnd) <= new Date(workBegin))
                {
                    document.getElementById("error_date").innerHTML = "Ngày nghỉ phải lớn hơn ngày vào làm";
                    return false;
                }
                const workID = $('.btn-resign').attr("data-workID");
                // console.log(workID);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: "{{route('accounts/resign_ajax')}}",
                    data: {workEnd:workEnd,workID:workID},
                    dataType: "JSON",
                    success: function (response) {
                        if(response.workEnd === 'successworkEnd')
                        {
                            alert('Đã chọn ngày nghỉ việc!');
                            location.reload();
                        }
                    }
                });
                
                // const workID = $(this).attr('data-workID');
            
                $.ajax({
                    type: "POST",
                    url: "{{route('accounts/resign_ajax')}}",
                    data: {workID:workID},
                    dataType: "JSON",
                    // success: function (response) {
                    //     if(response.result === 'success')
                    //     {
                    //         alert('Đã nghỉ việc!');
                    //     }
                    // }
                    });
                });
            // end chon ngay nghi            
    });
        
</script>  
@endsection