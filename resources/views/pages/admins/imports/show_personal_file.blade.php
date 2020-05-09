@extends('layouts.admin')
@section('content')
<div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Data Export</h3>
            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
            <div class="table-responsive">
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Đợt TN</th>
                            <th>Khoa</th>
                            <th>QĐ</th>
                            <th>Ngày ký</th>
                            <th>MSSV</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Nữ</th>
                            <th>Nơi sinh</th>
                            <th>Mã Lớp</th>
                            <th>Tên ngành</th>
                            <th>Tên chuyên ngành</th>
                            <th>AUN</th>
                            <th>GPA</th>
                            <th>DRL</th>
                            <th>TCTL</th>
                            <th>Xếp loại</th>
                            <th>Ghi chú</th>
                            <th>Dân tộc</th>
                            <th>Năm vào</th>
                            <th>Khóa</th>
                            <th>Danh hiệu</th>
                            <th>Loại đào tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($show as $row)
                                <tr>
                                    <td>{{$row->register_graduate_id}}</td>
                                    <td>{{$row->register_graduate_phase}}</td>
                                    <td>{{$row->register_graduate_academy}}</td>
                                    <td>{{$row->register_graduate_decision}}</td>
                                    <td>{{$row->register_graduate_date}}</td>
                                    <td>{{$row->register_graduate_code}}</td>
                                    <td>{{$row->register_graduate_name}}</td>
                                    <td>{{$row->register_graduate_birth}}</td>
                                    <td>{{$row->register_graduate_gender}}</td>
                                    <td>{{$row->register_graduate_place_of_birth}}</td>
                                    <td>{{$row->register_graduate_class_code}}</td>
                                    <td>{{$row->register_graduate_major_name}}</td>
                                    <td>{{$row->register_graduate_major_branch_name}}</td>
                                    <td>{{$row->register_graduate_AUN}}</td>
                                    <td>{{$row->register_graduate_GPA}}</td>
                                    <td>{{$row->register_graduate_DRL}}</td>
                                    <td>{{$row->register_graduate_TCTL}}</td>
                                    <td>{{$row->register_graduate_ranked}}</td>
                                    <td>{{$row->register_graduate_note}}</td>
                                    <td>{{$row->register_graduate_nation}}</td>
                                    <td>{{$row->register_graduate_year_begin}}</td>
                                    <td>{{$row->register_graduate_course}}</td>
                                    <td>{{$row->register_graduate_degree}}</td>
                                    <td>{{$row->register_graduate_type_of_tranning}}</td>
                                </tr>
                            @endforeach
                       
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- /.row -->
<script>
    $(document).ready(function () {
        $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
    });
    
</script>
@endsection