<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class acamajor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $data1 = array([
            'academy_id' => '1',
            'academy_code' => 'DI',
            'academy_name' => 'Công nghệ thông tin và Truyền thông',
        ]);
        DB::table('academies')->insert($data1);

        $data2 = array([
            'major_id' => '1',
            'major_code' => '95',
            'major_name' => 'Hệ thống thông tin',
        ], [
            'major_id' => '2',
            'major_code' => '96',
            'major_name' => 'Kỹ thuật phần mềm',
        ], [
            'major_id' => '3',
            'major_code' => '97',
            'major_name' => 'Truyền thông và mạng máy tính',
        ], [
            'major_id' => '4',
            'major_code' => 'Z6',
            'major_name' => 'Khoa học máy tính',
        ], [
            'major_id' => '5',
            'major_code' => 'V7',
            'major_name' => 'Công nghệ thông tin',
        ]);
        DB::table('majors')->insert($data2);

        $data3 = array([
            'major_branch_id' => '1',
            'major_branch_name' => 'Công nghệ thông tin',
        ], [
            'major_branch_id' => '2',
            'major_branch_name' => 'Tin học ứng dụng',
        ]);
        DB::table('major_branchs')->insert($data3);

        $so = $faker->unique()->numberBetween(1, 5);
        foreach (range(1, 5) as $index) {
            $so = $faker->unique()->numberBetween(1, 5);
            DB::table('classes')->insert([
            'major_id' => 1,
            'major_branch_id' => '',
            'class_code' => 'DI1695A'.$so,
            'class_name' => 'Hệ thống thông tin A'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ], [
            'major_id' => 2,
            'major_branch_id' => '',
            'class_code' => 'DI1696A'.$so,
            'class_name' => 'Kỹ thuật phần mềm A'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ], [
            'major_id' => 3,
            'major_branch_id' => '',
            'class_code' => 'DI1697A'.$so,
            'class_name' => 'Truyền thông và mạng máy tính'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ], [
            'major_id' => 4,
            'major_branch_id' => '',
            'class_code' => 'DI16Z6A'.$so,
            'class_name' => 'Khoa học máy tính'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ], [
            'major_id' => 5,
            'major_branch_id' => '1',
            'class_code' => 'DI16V7A'.$so,
            'class_name' => 'Công nghệ thông tin A'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ], [
            'major_id' => 6,
            'major_branch_id' => '2',
            'class_code' => 'KH16Y1A'.$so,
            'class_name' => 'Tin học ứng dụng A'.$so,
            'class_begin' => '2016-08-01',
            'class_end' => '2020-12-1',
            ]);
        }
    }
}
