<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class questions extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $data = array([
        'survey_id' => '1',
        'question_title' => 'Điện thoại gia đình',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => 'Điện thoại SV (số sẽ sử dụng lâu dài để Nhà Trường có thể liên hệ sau này)',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => 'Email đang sử dụng (Mail sẽ sử dụng lâu dài để Nhà Trường có thể liên hệ sau này, KHÔNG GHI EMAIL student)',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => 'Địa chỉ liên hệ',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn đánh giá thế nào về chương trình đào tạo mà bạn đã học?',
        'question_mandatory' => '1',
        'question_type' => 'Checkbox',
        'question_option' => '{"option":["Ph\u00f9 h\u1ee3p","C\u1ea7n t\u0103ng th\u00eam th\u1eddi l\u01b0\u1ee3ng gi\u1ea3ng d\u1ea1y l\u00fd thuy\u1ebft v\u00e0 th\u1ef1c h\u00e0nh","Ch\u1ec9 c\u1ea7n t\u0103ng th\u00eam gi\u1edd th\u1ef1c h\u00e0nh","Ch\u1ec9 c\u1ea7n t\u0103ng th\u00eam gi\u1edd l\u00fd thuy\u1ebft","T\u0103ng th\u00eam b\u00e0i t\u1eadp l\u1edbn","M\u1eddi th\u00eam m\u1ed9t s\u1ed1 chuy\u00ean gia \u1edf c\u00e1c c\u00f4ng ty d\u1ea1y 1 s\u1ed1 chuy\u00ean \u0111\u1ec1"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn đánh giá thế nào về cơ sở vật chất (CSVC) của Trường?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["Qu\u00e1 t\u1ec7","Ph\u00f9 h\u1ee3p, \u0111\u00e1p \u1ee9ng nhu c\u1ea7u h\u1ecdc t\u1eadp v\u00e0 sinh ho\u1ea1t","Hi\u1ec7n \u0111\u1ea1i"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn đánh giá thế nào về môi Trường học tập của nhà Trường?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["Qu\u00e1 t\u1ec7","Trung b\u00ecnh","Kh\u00e1 t\u1ed1t","R\u1ea5t t\u1ed1t"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn có hài lòng sau khi đã học tại Khoa CNTT&TT',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["Kh\u00f4ng h\u00e0i l\u00f2ng","H\u00e0i l\u00f2ng","R\u1ea5t h\u00e0i l\u00f2ng"]}',
        ], [
        'survey_id' => '1',
        'question_title' => '1 - Bạn đã có việc làm chưa? (Nếu đang đi NVQS thì cũng coi như đang có việc làm trong cơ quan Nhà nước)',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["C\u00f3 vi\u1ec7c l\u00e0m","\u0110ang h\u1ecdc cao h\u1ecdc","\u0110ang h\u1ecdc ng\u00e0nh\/ ngh\u1ec1 kh\u00e1c","Ch\u01b0a c\u00f3 vi\u1ec7c l\u00e0m"]}',
        ], [
        'survey_id' => '1',
        'question_title' => '2 - Bạn đang làm tại đơn vị thuộc loại nào? (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc","Doanh nghi\u1ec7p t\u01b0 nh\u00e2n","Doanh nghi\u1ec7p li\u00ean doanh v\u1edbi n\u01b0\u1edbc ngo\u00e0i","T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m (\u0111ang bu\u00f4n b\u00e1n ho\u1eb7c l\u00e0m m\u1ed9t c\u00f4ng vi\u1ec7c t\u1ef1 do kh\u00f4ng kh\u00f4ng thu\u1ed9c c\u00f4ng ty n\u00e0o)"]}',
        ], [
        'survey_id' => '1',
        'question_title' => '3 - Tên đơn vị bạn đang làm việc (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Textarea',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => '4 - Địa chỉ đơn vị bạn đang làm việc (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Textarea',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => '5 - Đơn vị bạn đang làm thuộc tỉnh/ TP nào (Chỉ trả lời nếu bạn đã có việc làm)?',
        'question_mandatory' => null,
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => '6 - Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không? (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o","Ch\u01b0a \u0111\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"]}',
        ], [
        'survey_id' => '1',
        'question_title' => '7 - Kiến thức và kỹ năng mà chương trình đã cung cấp cho Anh/Chị có đáp ứng được yêu cầu công việc mà Anh/Chị đang làm hay chưa? (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '1',
        'question_title' => '8 - Thu nhập bình quân/tháng của Anh/Chị hiện nay là:',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["D\u01b0\u1edbi 5 tri\u1ec7u","T\u1eeb 5 - 10 tri\u1ec7u","Tr\u00ean 10 tri\u1ec7u"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn hài lòng với công việc hiện tại không? (Chỉ trả lời nếu bạn đã có việc làm)',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["R\u1ea5t h\u00e0i l\u00f2ng","H\u00e0i l\u00f2ng","Kh\u00f4ng h\u00e0i l\u00f2ng"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn có dự định học tiếp cao học không?',
        'question_mandatory' => null,
        'question_type' => 'Radio',
        'question_option' => '{"option":["C\u00f3","Kh\u00f4ng"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Nếu học cao học tại Khoa CNTT&TT trường Đại học Cần Thơ, bạn muốn học ngành nào?',
        'question_mandatory' => null,
        'question_type' => 'Checkbox',
        'question_option' => '{"option":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin","Khoa h\u1ecdc m\u00e1y t\u00ednh","M\u1ee5c kh\u00e1c:"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn có việc làm vào tháng - năm nào (chỉ trả lời nếu bạn đã có việc làm). Ví dụ cách ghi như sau: 06-2019 (tháng ghi 2 chữ số), nếu chưa có việc làm thì ghi 00-0000',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn mong muốn làm việc tại công ty loại nào?',
        'question_mandatory' => '1',
        'question_type' => 'Checkbox',
        'question_option' => '{"option":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc","Doanh nghi\u1ec7p li\u00ean doanh v\u1edbi n\u01b0\u1edbc ngo\u00e0i","Doanh nghi\u1ec7p t\u01b0 nh\u00e2n","T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m"]}',
        ], [
        'survey_id' => '1',
        'question_title' => 'Bạn mong muốn làm việc ở vị trí nào?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["L\u1eadp tr\u00ecnh vi\u00ean","Chuy\u00ean vi\u00ean t\u01b0 v\u1ea5n v\u1ec1 CNTT","Gi\u1ea3ng vi\u00ean\/ gi\u00e1o vi\u00ean CNTT","Qu\u1ea3n l\u00fd"]}',
        ]);
        DB::table('questions')->insert($data);
    }
}
