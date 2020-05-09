<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class register extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('register_graduate')->insert([
                'register_graduate_semester' => $faker->numberBetween(1, 3),
                'register_graduate_session' => '2018 - 2019',
                'register_graduate_date' => '2019-01-01',
                'register_graduate_GPA' => $faker->numberBetween(2, 3).'.'.$faker->numberBetween(0, 9),
                'register_graduate_DRL' => $faker->numberBetween(70, 100),
                'register_graduate_TCTL' => $faker->numberBetween(130, 155),
                'register_graduate_rank' => $faker->randomElement(['Xuất sắc', 'Giỏi', 'Khá', 'Trung bình']),
                'register_graduate_degree' => $faker->address,
                'register_graduate_study_program' => 'Đại học - Chính quy',
                'user_id' => $faker->unique()->numberBetween(1, 50),
                ]);
        }
    }
}
