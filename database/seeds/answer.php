<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class answer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $sdt = mt_rand(0, 9);
        $faker = Faker::create();
        $ctdt = json_encode('Mời thêm một số chuyên gia ở các công ty dạy 1 số chuyên đề', true);
        $dilam = json_encode('Có việc làm', true);
        $company = json_encode($faker->name);
        $duoi5 = json_encode('Dưới 5 triệu', true);
        $nam10 = json_encode('Từ 5 - 10 triệu', true);
        $tren10 = json_encode('Trên 10 triệu', true);
        //dưới 5 triệu
        foreach (range(1, 34) as $index) {
            DB::table('answers')->insert([
            'survey_id' => 1,
            'user_id' => 1,
            // 'answer_content' => '{"1":{"answer":"'.str_random(10).'"},"2":{"answer":"'.str_random(10).'"},"3":{"answer":"'.$faker->email.'"},"4":{"answer":"'.$faker->address.'"},"5":['.$ctdt.'],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"9":['.$dilam.'],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":'.$company.'},"12":{"answer":"'.$faker->address.'"},"13":{"answer":"'.$faker->address.'"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$salary.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"05\/2000"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            // 'answer_content' => '{"1":{"answer":"123"},"2":{"answer":"123"},"3":{"answer":"123"},"4":{"answer":"123"},"5":["Ph\u00f9 h\u1ee3p"],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":"123"},"12":{"answer":"123"},"13":{"answer":"123"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$duoi5.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"123"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            'answer_content' => '{"1":{"answer":"0123456789"},"2":{"answer":"0123456789"},"3":{"answer":"abc@gmail.com"},"4":{"answer":"C\u00e2\u0300n Th\u01a1"},"5":["Ph\u00f9 h\u1ee3p","C\u1ea7n t\u0103ng th\u00eam th\u1eddi l\u01b0\u1ee3ng gi\u1ea3ng d\u1ea1y l\u00fd thuy\u1ebft v\u00e0 th\u1ef1c h\u00e0nh","T\u0103ng th\u00eam b\u00e0i t\u1eadp l\u1edbn","M\u1eddi th\u00eam m\u1ed9t s\u1ed1 chuy\u00ean gia \u1edf c\u00e1c c\u00f4ng ty d\u1ea1y 1 s\u1ed1 chuy\u00ean \u0111\u1ec1"],"6":["Qu\u00e1 t\u1ec7"],"7":["Trung b\u00ecnh"],"8":["R\u1ea5t h\u00e0i l\u00f2ng"],"9":["C\u00f3 vi\u1ec7c l\u00e0m"],"10":["T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m (\u0111ang bu\u00f4n b\u00e1n ho\u1eb7c l\u00e0m m\u1ed9t c\u00f4ng vi\u1ec7c t\u1ef1 do kh\u00f4ng kh\u00f4ng thu\u1ed9c c\u00f4ng ty n\u00e0o)"],"11":{"answer":"CTU"},"12":{"answer":"Xu\u00e2n Kha\u0301nh"},"13":{"answer":"C\u00e2\u0300n Th\u01a1"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$duoi5.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"01-2019"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            ]);
        }
        //từ 5 đến 1- triệu
        foreach (range(1, 40) as $index) {
            DB::table('answers')->insert([
            'survey_id' => 1,
            'user_id' => 1,
            // 'answer_content' => '{"1":{"answer":"'.str_random(10).'"},"2":{"answer":"'.str_random(10).'"},"3":{"answer":"'.$faker->email.'"},"4":{"answer":"'.$faker->address.'"},"5":['.$ctdt.'],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"9":['.$dilam.'],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":'.$company.'},"12":{"answer":"'.$faker->address.'"},"13":{"answer":"'.$faker->address.'"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$salary.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"05\/2000"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            // 'answer_content' => '{"1":{"answer":"123"},"2":{"answer":"123"},"3":{"answer":"123"},"4":{"answer":"123"},"5":["Ph\u00f9 h\u1ee3p"],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":"123"},"12":{"answer":"123"},"13":{"answer":"123"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$duoi5.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"123"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            'answer_content' => '{"1":{"answer":"0123456789"},"2":{"answer":"0123456789"},"3":{"answer":"abc@gmail.com"},"4":{"answer":"C\u00e2\u0300n Th\u01a1"},"5":["Ph\u00f9 h\u1ee3p","C\u1ea7n t\u0103ng th\u00eam th\u1eddi l\u01b0\u1ee3ng gi\u1ea3ng d\u1ea1y l\u00fd thuy\u1ebft v\u00e0 th\u1ef1c h\u00e0nh","T\u0103ng th\u00eam b\u00e0i t\u1eadp l\u1edbn","M\u1eddi th\u00eam m\u1ed9t s\u1ed1 chuy\u00ean gia \u1edf c\u00e1c c\u00f4ng ty d\u1ea1y 1 s\u1ed1 chuy\u00ean \u0111\u1ec1"],"6":["Qu\u00e1 t\u1ec7"],"7":["Trung b\u00ecnh"],"8":["R\u1ea5t h\u00e0i l\u00f2ng"],"9":["C\u00f3 vi\u1ec7c l\u00e0m"],"10":["T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m (\u0111ang bu\u00f4n b\u00e1n ho\u1eb7c l\u00e0m m\u1ed9t c\u00f4ng vi\u1ec7c t\u1ef1 do kh\u00f4ng kh\u00f4ng thu\u1ed9c c\u00f4ng ty n\u00e0o)"],"11":{"answer":"CTU"},"12":{"answer":"Xu\u00e2n Kha\u0301nh"},"13":{"answer":"C\u00e2\u0300n Th\u01a1"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$nam10.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"01-2019"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            ]);
        }
        //trên 10 triệu
        foreach (range(1, 22) as $index) {
            DB::table('answers')->insert([
            'survey_id' => 1,
            'user_id' => 1,
            // 'answer_content' => '{"1":{"answer":"'.str_random(10).'"},"2":{"answer":"'.str_random(10).'"},"3":{"answer":"'.$faker->email.'"},"4":{"answer":"'.$faker->address.'"},"5":['.$ctdt.'],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"9":['.$dilam.'],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":'.$company.'},"12":{"answer":"'.$faker->address.'"},"13":{"answer":"'.$faker->address.'"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$salary.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"05\/2000"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            // 'answer_content' => '{"1":{"answer":"123"},"2":{"answer":"123"},"3":{"answer":"123"},"4":{"answer":"123"},"5":["Ph\u00f9 h\u1ee3p"],"6":["Qu\u00e1 t\u1ec7"],"7":["Qu\u00e1 t\u1ec7"],"8":["Kh\u00f4ng h\u00e0i l\u00f2ng"],"10":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"11":{"answer":"123"},"12":{"answer":"123"},"13":{"answer":"123"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$duoi5.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"123"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            'answer_content' => '{"1":{"answer":"0123456789"},"2":{"answer":"0123456789"},"3":{"answer":"abc@gmail.com"},"4":{"answer":"C\u00e2\u0300n Th\u01a1"},"5":["Ph\u00f9 h\u1ee3p","C\u1ea7n t\u0103ng th\u00eam th\u1eddi l\u01b0\u1ee3ng gi\u1ea3ng d\u1ea1y l\u00fd thuy\u1ebft v\u00e0 th\u1ef1c h\u00e0nh","T\u0103ng th\u00eam b\u00e0i t\u1eadp l\u1edbn","M\u1eddi th\u00eam m\u1ed9t s\u1ed1 chuy\u00ean gia \u1edf c\u00e1c c\u00f4ng ty d\u1ea1y 1 s\u1ed1 chuy\u00ean \u0111\u1ec1"],"6":["Qu\u00e1 t\u1ec7"],"7":["Trung b\u00ecnh"],"8":["R\u1ea5t h\u00e0i l\u00f2ng"],"9":["C\u00f3 vi\u1ec7c l\u00e0m"],"10":["T\u1ef1 t\u1ea1o vi\u1ec7c l\u00e0m (\u0111ang bu\u00f4n b\u00e1n ho\u1eb7c l\u00e0m m\u1ed9t c\u00f4ng vi\u1ec7c t\u1ef1 do kh\u00f4ng kh\u00f4ng thu\u1ed9c c\u00f4ng ty n\u00e0o)"],"11":{"answer":"CTU"},"12":{"answer":"Xu\u00e2n Kha\u0301nh"},"13":{"answer":"C\u00e2\u0300n Th\u01a1"},"14":["\u0110\u00fang v\u1edbi ng\u00e0nh \u0111\u01b0\u1ee3c \u0111\u00e0o t\u1ea1o"],"15":["\u0110\u00e1p \u1ee9ng \u0111\u01b0\u1ee3c y\u00eau c\u1ea7u c\u00f4ng vi\u1ec7c"],"16":['.$tren10.'],"17":["R\u1ea5t h\u00e0i l\u00f2ng"],"18":["C\u00f3"],"19":["H\u1ec7 th\u1ed1ng Th\u00f4ng tin"],"20":{"answer":"01-2019"},"21":["C\u01a1 quan nh\u00e0 n\u01b0\u1edbc"],"22":["L\u1eadp tr\u00ecnh vi\u00ean"]}',
            ]);
        }
    }
}
