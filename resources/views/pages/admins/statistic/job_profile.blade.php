@extends('layouts.admin')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
h3{
  font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
}
th{
  text-align: center;
  font-weight: 450;
}
table{
  text-align: center;
  font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
}
table#table_statistic {
font-size: 10px;
}
table#table_statistic {
    font-size: 15px;
}
abbr[title] {
    border: none;
text-decoration: none;
}
</style>

<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
                <div class="white-box">
                        {{-- <div class="row">
                                <h3 class="box-title">THỐNG KÊ TỈ LỆ VIỆC LÀM CỦA CỰU SINH VIÊN</h3>
                                @if($name != "")
                                <h3 class="box-title text-info">&nbsp; TỐT NGHIỆP NĂM {{$name}}</h3>
                                @endif
                                <h3 class="box-title">&nbsp; KHOA CNTT&TT THÔNG QUA KHẢO SÁT</h3>
                            </div> --}}
                <br>
                <br>
                <div>
                        {{-- <form action="{{route('statistic.job_profile')}}" method="post">
                            @csrf
                            <div class="container-fluid ">
                                <table>
                                        <tr>
                                            <td><input type="radio" value="cohort" name="check" @if($check=='cohort') checked @endif></td>
                                            <td>Khóa &nbsp;</td>
                                            <td  style="padding-right: 20px;">
                                                <select name="cohort" id="cohort" style="width: 90px!important;"  >
                                                    <option value="all" selected>Tất cả</option>
                                                    @foreach($course as $y)
                                                
                                                    <option value="{{$y->year}}" @if($y->year==$hienthi_course) selected @endif>
                                                        {{$y->year-1974}}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </td>
                                            <td rowspan="2"><button class="btn btn-info" type="submit">Thống kê</button></td>

                                        </tr>
                                        <tr>
                                            <td><input type="radio" value="year"  name="check" @if($check=='year') checked @endif></td>
                                            <td>Năm &nbsp;</td>
                                            <td  style="padding-right: 20px;"><select name="year" id="year" style="width: 90px!important;"  >
                                                    <option value="all" selected>Tất cả</option>
                                                    @foreach($selectyear as $y)
                                                        <option value="{{$y->year}}" @if($y->year==$hienthi_year) selected @endif>{{$y->year}}</option>
                                                    @endforeach
                                                    
                                                    </select>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td><button class="btn btn-info" type="submit">Thống kê</button></td>
                                        </tr>
                                </table>
                            </div>
                        </form>--}}
                </div>
                <div>
                        {{-- <form action="{{ action('Master\StatisticController@job_export') }}" method="POST">
                            @csrf
                                <input type="hidden" name="data_export" value="{{$data_export}}">
                                <button type="submit" class="btn btn-success" style="float:right">Export</button>
                        </form> --}}
                </div>
                <br>
                <br>
                <br>
                <h2 style="text-align: center;font-weight: 400;font-family: 'Roboto Condensed', Arial, sans-serif;">Thống kê tỉ lệ có việc làm theo hồ sơ cá nhân của sinh viên</h2>
                <div class="table table-responsive">
                    <table  id="table_statistic" class="table table-bordered " >
                        <thead>
                            <tr>
                                <th rowspan="2">Mã ngành</th>
                                <th rowspan="2">Tên ngành đào tạo</th>
                                <th rowspan="1" colspan="2">Số SV đã tốt nghiệp</th>
                                <th rowspan="1"colspan="2">Tỉ lệ có việc làm</th>
                                <th rowspan="1"colspan="3">Tỉ lệ Mức lương</th>
                                
                            </tr>
                            <tr>
                                <th rowspan="1">Tổng số</th>
                                <th rowspan="1">Số SV nữ</th>
                                <th rowspan="1">Tỷ lệ chung (%)</th>
                                <th rowspan="1">Tỷ lệ nữ (%)</th>
                                <th rowspan="1">Lương dưới 5 triệu (%)</th>
                                <th rowspan="1">Lương từ 5 đến 10 triệu (%)</th>
                                <th rowspan="1">Lương trên 10 triệu (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                               @foreach($major as $value1)
                                <tr>
                                    <td>{{$value1->major_code}}</td>
                                    <td>{{$value1->major_name}}</td>
                                    <td>{{$total_graduate [$value1->major_code]}}</td>
                                    <td>{{$total_graduate_female [$value1->major_code]}}</td>
                                    <td>{{$tilevieclam [$value1->major_code]}} 
                                        {{-- ({{$dacovieclam [$value1->major_code]}}) --}}
                                    </td>
                                    <td ><abbr title="{{$dacovieclamnu [$value1->major_code]}}">{{$phantram_dacovieclamnu [$value1->major_code]}} </abbr>
                                        {{-- ({{$dacovieclamnu [$value1->major_code]}}) --}}
                                    </td>
                                    <td ><abbr title="{{$count_duoi5 [$value1->major_code]}}">{{$phantram_count_duoi5 [$value1->major_code]}} </abbr>
                                        {{-- ({{$count_duoi5 [$value1->major_code]}}) --}}
                                    </td>
                                    <td><abbr title="{{$count_5den10 [$value1->major_code]}}">{{$phantram_count_5den10 [$value1->major_code]}} </abbr>
                                        {{-- ({{$count_5den10 [$value1->major_code]}})  --}}
                                    </td>
                                    <td><abbr title="{{$count_tren10 [$value1->major_code]}}">{{$phantram_count_tren10 [$value1->major_code]}} </abbr>
                                        {{-- ({{$count_tren10 [$value1->major_code]}})  --}}
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>{{-- end div table-responsive --}}

            </div>{{-- end div white-box --}}
        </div>{{-- end div col-sm-12 --}}
    </div> {{-- end div row --}}
</div>{{-- end div container-fluid --}}
</div>{{-- end div page-wrapper --}}

@endsection

@section('script')
<script>
$(document).ready(function(){
    $('#table_statistic').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        }); 
    // Ajax
    $("#major").change(function(){
        var major_id = $(this).val();
        $.get("../statistic/major_branch/"+major_id, function(data){
            $("#major_branch").html(data);
        });
    });
    
    // Ajax
    $("#major,#major_branch,#course").change(function(){
        var major_id = $("#major").val();
        var major_branch_id = $("#major_branch").val();
        var course = $("#course").val();
        $.get("../statistic/class/"+major_id+'/'+major_branch_id+'/'+course, function(data){
            $("#class").html(data);
        });
        
    });
});
</script>
@endsection
