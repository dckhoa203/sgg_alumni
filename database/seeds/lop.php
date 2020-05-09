<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class lop extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('classes')->insert([
            'major_branch_id' => 1,
            'class_code' => 'DI1695A'.$faker->unique()->numberBetween(1, 50),
            'class_name' => 'Hệ thống thông tin A'.$faker->numberBetween(1, 50),
            'class_begin' => $faker->date,
            'class_end' => $faker->date,
            ]);
        }
    }
}
