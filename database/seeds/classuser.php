<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class classuser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('class_users')->insert([
            'class_id' => $faker->unique()->numberBetween(1, 50),
            'user_id' => $faker->unique()->numberBetween(1, 50),
            'class_user_accountability' => 'Sinh viên',
            ]);
        }
    }
}
