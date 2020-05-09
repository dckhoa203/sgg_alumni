<style>
th{
    text-align: center;
}
</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                    <div class="white-box">
                    <h3 class="box-title">{{$data['name']}}</h3>
                    <br>
                    {{-- <div class="table"> --}}
                        <table class="table table-bordered " align="center">
                            <thead>
                                <tr>
                                    <th rowspan="3">Mã ngành</th>
                                    <th rowspan="3">Tên ngành đào tạo</th>
                                    {{-- <th rowspan="3">Tên chuyên ngành</th>
                                    <th rowspan="3">Lớp</th> --}}
                                    <th colspan="2">Số SV tốt nghiệp</th>
                                    <th colspan="2">Số SV phản hồi</th>
                                    <th colspan="5">Tình hình việc làm</th>
                                    <th rowspan="3">Tỷ lệ SV có việc làm/tổng số SV phản hồi</th>
                                    <th rowspan="3">Tỷ lệ SV có việc làm/tổng số SVTN</th>
                                    <th colspan="4">Khu vực làm việc</th>
                                    <th rowspan="3">Nơi làm việc (Tỉnh/TP)</th>
                                    
                                </tr>
                                <tr>
                                    <th rowspan="2">Tổng số</th>
                                    <th rowspan="2">Nữ</th>
                                    <th rowspan="2">Tổng số</th>
                                    <th rowspan="2">Nữ</th>
                                    <th colspan="3">Có việc làm</th>
                                    <th rowspan="2">Tiếp tục học</th>
                                    <th rowspan="2">Chưa có việc làm</th>
                                    <th rowspan="2">Nhà nước</th>
                                    <th rowspan="2">Tư nhân</th>
                                    <th rowspan="2">Tự tạo việc làm</th>
                                    <th rowspan="2">Có yếu tố nước ngoài</th>
                                </tr>
                                <tr>
                                        <th>Đúng ngành đào tạo</th>
                                        <th>Liên quan đến ngành đào tạo</th>
                                        <th>Không liên quan đến ngành đào tạo</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                               
                                   @foreach($data['major'] as $key1 => $value1)
                                   <tr>
                                    <td>{{$value1['major_code']}}</td>
                                    <td>{{$value1['major_name']}}</td>
                                    {{-- <td>-</td>
                                    <td>-</td> --}}
                                    <td>{{$data['total_graduate'][$value1['major_code']]}}</td>
                                    <td>{{$data['total_graduate_female'][$value1['major_code']]}}</td>
                                    <td>{{$data['feedback'][$value1['major_code']]}}</td>
                                    <td>{{$data['female_feedback'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_dungnganhdaotao'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_lienquandennganhdaotao'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_khonglienquandennganhdaotao'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_tieptuchoc'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_chuacovieclam'][$value1['major_code']]}}</td>
                                    <td>{{$data['tile_vieclam_phanhoi'][$value1['major_code']]}}</td>
                                    <td>{{$data['tile_vieclam_tongtn'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_nhanuoc'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_tunhan'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_tutaovieclam'][$value1['major_code']]}}</td>
                                    <td>{{$data['count_coyeutonuocngoai'][$value1['major_code']]}}</td>
                                    <td>-</td>
                                 </tr>   
                                    @endforeach
                               
                            </tbody>
                        </table>
                    {{-- </div>end div table-responsive --}}

                </div>{{-- end div white-box --}}
            </div>{{-- end div col-sm-12 --}}
        </div> {{-- end div row --}}
    </div>{{-- end div container-fluid --}}
</div>{{-- end div page-wrapper --}}