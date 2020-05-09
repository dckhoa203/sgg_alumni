@extends('layouts.admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                    <div class="white-box">
                    
                    <br>
                    <br>
                    <div>
                            <form action="{{route('statistic.student_sort')}}" method="post">
                                @csrf
                                <div class="container-fluid ">
                                    <table>
                                        <tr><td>Khóa &nbsp;</td>
                                            <td  style="padding-right: 20px;"><select name="course" id="course" style="width: 90px!important;"  >
                                                    <option value="all" selected>Tất cả</option>
                                                    @foreach($course as $y)
                                                    
                                                        <option value="{{$y->year}}" @if($y->year==$hienthi_course) selected @endif>
                                                            {{$y->year-1974}}
                                                        </option>
                                                    @endforeach
                                                    
                                            </select>
                                            <td >Ngành &nbsp;</td>
                                            <td>
                                           <select name="major"  id="major" style="width: 250px;" >
                                                <option value="all">Tất cả</option>
                                                @foreach($nganh as $item) 
                                                    <option value="{{$item->major_id}}" @if($item->major_id==$hienthi_major) selected @endif>{{$item->major_name}}</option>
                                                @endforeach
                                            </select>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                        
<br>
                                        <button class="btn btn-success" type="submit">Thống kê</button>
                                </div>
                            </form>
                    </div>
                    <h2 style="text-align: center;font-weight: 400;font-family: 'Roboto Condensed', Arial, sans-serif;}">{{$name}}</h2>
                    <div class="table-responsive">
                        <table  id="table_statistic" class="table color-table primary-table">
                            <thead>
                                <tr>
                                    @if($column==1)
                                    <th>Ngành</th>
                                    @else 
                                    <th>Lớp</th>
                                    @endif
                                    <th>Tổng số sinh viên</th>
                                    <th>Số sinh viên đã tốt nghiệp</th>
                                    <th>Số sinh viên trung bình</th>
                                    <th>Số sinh viên khá</th>
                                    <th>Số sinh viên giỏi</th>
                                    <th>Số sinh viên xuất sắc</th>
                                    <th>Tỉ lệ tốt nghiệp (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($major as $value1)
                                    {{-- {{dd($value1)}} --}}
                                    <tr>
                                        @if($column==1) 
                                        {{-- hiển thị ngành --}}
                                                <td>{{$value1->major_name}}</td>
                                                <td>{{$total_student[$value1->major_code]}}</td>
                                                <td>{{$register_graduate_pass[$value1->major_code]}}</td>
                                                <td>{{$trungbinh[$value1->major_code]}} ({{$tiletrungbinh[$value1->major_code]}} %)</td>
                                                <td>{{$kha[$value1->major_code]}} ({{$tilekha[$value1->major_code]}} %)</td>
                                                <td>{{$gioi[$value1->major_code]}} ({{$tilegioi[$value1->major_code]}} %)</td>
                                                <td>{{$xuatsac[$value1->major_code]}} ({{$tilexuatsac[$value1->major_code]}} %)</td>
                                                <td>{{$per[$value1->major_code]}} </td>
                                        @else 
                                        {{-- hiển thị lớp --}}
                                                <td>{{$value1->class_code}}</td>
                                                <td>{{$total_student[$value1->class_code]}}</td>
                                                <td>{{$register_graduate_pass[$value1->class_code]}}</td>
                                                <td>{{$trungbinh[$value1->class_code]}} ({{$tiletrungbinh[$value1->class_code]}} %)</td>
                                                <td>{{$kha[$value1->class_code]}} ({{$tilekha[$value1->class_code]}} %)</td>
                                                <td>{{$gioi[$value1->class_code]}} ({{$tilegioi[$value1->class_code]}} %)</td>
                                                <td>{{$xuatsac[$value1->class_code]}} ({{$tilexuatsac[$value1->class_code]}} %)</td>
                                                <td>{{$per[$value1->class_code]}} </td>
                                        @endif
                                    </tr>
                                        
                                            
                                        
                                    @endforeach
                                    <tr style="font-weight: bold;">
                                        <td>Tổng:</td>
                                            <td>{{$tong_sv}}</td>
                                            <td>{{$tong_cuusv}}</td>
                                            <td>{{$tong_trungbinh}} ({{$tong_tiletrungbinh}} %)</td>
                                            <td>{{$tong_kha}} ({{$tong_tilekha}} %)</td>
                                            <td>{{$tong_gioi}} ({{$tong_tilegioi}} %)</td>
                                            <td>{{$tong_xuatsac}} ({{$tong_tilexuatsac}} %)</td>
                                            <td>{{$tong_per}} </td>
                                    </tr>
                                      
                            </tbody>
                        </table>
                    </div>{{-- end div table-responsive --}}

                </div>{{-- end div white-box --}}
            </div>{{-- end div col-sm-12 --}}
        </div> {{-- end div row --}}
    </div>{{-- end div container-fluid --}}
</div>{{-- end div page-wrapper --}}
{{-- <script src="{{asset('jquery-3.4.1.min.js')}}"></script> --}}
{{-- <script type="text/javascript">
    $(document).ready(function () {
        var url = "{{ url('statistic/showMajor') }}";
        $("#course").change(function(){
            var course = $('#course').val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    course: course,
                    _token: token
                },
                success: function(data) {
                    $("#major").html('');
                    // $.each(data, function(key, value){
                    //     $("select[name='major']").append(
                    //         "<option value=" + value.major_id + ">" + value.major_name + "</option>"
                    //     );
                    // });
                }
            });
        });
    });
</script> --}}

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function () {
    
        

        // $("#course").change(function(){
        //     var course = $(this).val();
        //     $.get("../statistic/major/"+course, function(data){
        //         $("#major").html(data);
        //     });
        // }); 

        $('#table_statistic').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
    });
    </script>
@endsection