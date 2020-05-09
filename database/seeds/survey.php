<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class survey extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array([
            'survey_id' => '1',
            'user_id' => '1',
            'survey_name' => 'NHẬN QĐ TỐT NGHIỆP KHOA CNTT & TT Từ ngày 02/07/2019',
            'survey_description' => 'Chào các em,
            Các em tốt nghiệp HK2-2018-2019 sẽ nhận quyết định từ ngày 02/07/2019 - 11/07/2019 (cần xuất trình CMND hoặc giấy tờ có dán ảnh).  Nếu SV không nhận trong thời gian này thì sẽ nhận vào thời gian nhận bằng tốt nghiệp. Lưu ý: phải giữ quyết định này thì mới nhận bằng tốt nghiệp được.
            - SV khoa CNTT&TT nhận tại Thư viện Khoa CNTT&TT
            - SV chưa hoàn thành thanh toán phải có xác nhận của đơn vị có liên quan vào Phiếu thanh toán ra trường. 
            - SV khoa CNTT&TT nhận bảng điểm tại  Thư viện Khoa CNTT&TT từ 06/08/2019 - 30/08/2019
            - SV liên hệ PĐT nhận bằng tốt nghiệp từ ngày 06/08/2019 - 30/08/2019 (cần xuất trình QĐ tốt nghiệp và CMND hoặc giấy tờ có dán ảnh)
            - Lễ tốt nghiệp sẽ tổ chức trong tháng 9/2019. Tháng 8 Khoa sẽ có thông báo cụ thể qua email sinh viên
            SV hoàn thành mẫu này trước khi nhận quyết định',
            'survey_start' => '2019-08-22',
            'survey_end' => '2020-08-31',
            'survey_version' => '1',
        ]);
        DB::table('surveys')->insert($data);
    }
}
