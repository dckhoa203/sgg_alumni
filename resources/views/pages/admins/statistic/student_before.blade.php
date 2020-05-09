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
                                                        <option value="{{$y->year}}">{{$y->year-1974}}</option>
                                                    @endforeach
                                                    
                                            </select>
                                            <td >Ngành &nbsp;</td>
                                            <td>
                                           <select name="major"  id="major" style="width: 400px;" >
                                                <option value="all">Tất cả</option>
                                                @foreach($major as $item)
                                                    <option value="{{$item->major_id}}">{{$item->major_name}}</option>
                                                @endforeach
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>Chuyên ngành &nbsp;</td>
                                            <td>
                                            <select name="major_branch" id="major_branch" style="width: 400px;" >
                                                <option value="all">Tất cả</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                                <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>Lớp &nbsp;</td>
                                            <td>
                                            <select name="class" id="class" style="width: 400px;">
                                                <option value="all">Tất cả</option>
                                            </select>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                        

                                        <button class="btn btn-success" type="submit">Thống kê</button>
                                </div>
                            </form>
                    </div>
                    <h2 style="text-align: center;font-weight: 400;">{{$name}}</h2>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
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
                               <tr>
                                <td>{{$total_student}}</td>
                                <td>{{$register_graduate_pass}}</td>
                                <td>{{$trungbinh}} ({{$tiletrungbinh}}%)</td>
                                <td>{{$kha}} ({{$tilekha}}%)</td>
                                <td>{{$gioi}} ({{$tilegioi}}%)</td>
                                <td>{{$xuatsac}} ({{$tilexuatsac}}%)</td>
                                <td>{{$per}} </td>
                               </tr>
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