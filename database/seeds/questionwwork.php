<?php

use Illuminate\Database\Seeder;

class questionwwork extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $data = array([
        'survey_id' => '2',
        'question_title' => '1. Anh/Chị có việc làm hay chưa?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\"C\u00f3 vi\u1ec7c  (Ti\u1ebfp t\u1ee5c kh\u1ea3o s\u00e1t)\"","\"Ch\u01b0a - \u0110ang h\u1ecdc (K\u1ebft th\u00fac kh\u1ea3o s\u00e1t)\"","\"Ch\u01b0a c\u00f3 (K\u1ebft th\u00fac kh\u1ea3o s\u00e1t)\""]}',
        ], [
        'survey_id' => '2',
        'question_title' => '2.Anh/chị tìm được việc làm trong khoảng thời gian nào sau đây?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["Tr\u01b0\u1edbc khi t\u1ed1t nghi\u1ec7p","Trong v\u00f2ng 3 th\u00e1ng sau khi t\u1ed1t nghi\u1ec7p","Trong v\u00f2ng 6 th\u00e1ng sau khi t\u1ed1t nghi\u1ec7p","Sau 6 th\u00e1ng sau khi t\u1ed1t nghi\u1ec7p"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '3. Anh/chị làm việc trong khu vực nào?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["Nh\u00e0 n\u01b0\u1edbc","T\u01b0 nh\u00e2n","Li\u00ean doanh n\u01b0\u1edbc ngo\u00e0i","\"T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m \""]}',
        ], [
        'survey_id' => '2',
        'question_title' => '4. Vui lòng cho biết Tên cơ quan/công ty anh/chị đang  làm việc?   (Bao gồm cả hình thức Anh/Chị tự tạo việc làm)',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '2',
        'question_title' => '5.Anh/Chị vui lòng cho biết Địa chỉ cơ quan/công ty mà anh/chị đang làm việc?',
        'question_mandatory' => '1',
        'question_type' => 'Text',
        'question_option' => null,
        ], [
        'survey_id' => '2',
        'question_title' => '6. Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u00e0o t\u1ea1o","Kh\u00f4ng \u0111\u00fang v\u1edbi ng\u00e0nh \u0111\u00e0o t\u1ea1o","Kh\u00f4ng li\u00ean quan \u0111\u1ebfn ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '7.CTĐT trang bị cho Anh/Chị kiến thức chuyên môn đáp ứng được yêu cầu công việc đang làm hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '8.CTĐT trang bị cho Anh/Chị kỹ năng chuyên môn đáp ứng được yêu cầu công việc đang làm hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '9.CTĐT trang bị cho Anh/Chị kỹ năng ngoại ngữ đáp ứng được yêu cầu công việc đang làm hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '10.CTĐT trang bị cho Anh/Chị kỹ năng công nghệ thông tin đáp ứng được yêu cầu công việc đang làm hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '11. CTĐT trang bị cho Anh/Chị kỹ năng mềm đáp ứng được yêu cầu công việc đang làm hay không?',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c","Ch\u01b0a \u0111\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"]}',
        ], [
        'survey_id' => '2',
        'question_title' => '12. Vui lòng cho biết  mức Thu nhập bình quân/tháng của Anh/Chị hiện nay là:',
        'question_mandatory' => '1',
        'question_type' => 'Radio',
        'question_option' => '{"option":["D\u01b0\u1edbi 5 tri\u1ec7u\/th\u00e1ng","T\u1eeb 5 - 10 tri\u1ec7u\/th\u00e1ng","Tr\u00ean 10 tri\u1ec7u\/th\u00e1ng"]}',
        ]);
        DB::table('questions')->insert($data);
    }
}
