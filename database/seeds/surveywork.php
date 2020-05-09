<?php

use Illuminate\Database\Seeder;

class surveywork extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $data = array([
            'survey_id' => '2',
            'user_id' => '1',
            'survey_name' => 'Thống kê tình hình việc làm của sinh viên sau khi ra trường',
            'survey_description' => '(2) (3) Mã, tên ngành: Ghi đúng quy định tại Thông tư 24/2017/TT_BGDĐT ngày 10/10/2017, không viết tắt, không thêm dấu chấm, dấu phẩy ở cuối.
            Ví dụ: (2) 7210234 (3) Diễn viên kịch, điện ảnh - truyền hình; mỗi ngành báo cáo tổng số cuối cùng trong một dòng, không báo cáo theo chuyên ngành. (Các mã ngành CĐSP ghi theo quy định tại Thông tư 15/VBHN-BGDĐT ngày 08/5/2014 (văn bản hợp nhất), TCSP ghi theo quy định tại Thông tư 34/2011/TT-BGDĐT ngày 11/8/2011).
            (4) (5) ghi đủ số sinh viên tốt nghiệp của năm, bao gồm số sinh viên tốt nghiệp chậm, bảo lưu từ những khóa trước.
            (13) (14) SV có việc làm = Số sinh viên tốt nghiệp có việc làm + Số sinh viên tiếp tục học.',
            'survey_start' => '2019-08-22',
            'survey_end' => '2020-08-31',
            'survey_version' => '1',
        ]);
        DB::table('surveys')->insert($data);
    }
}
