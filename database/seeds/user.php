<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('users')->insert([
            'code' => Str::random(10),
            'name' => $faker->name,
            'password' => bcrypt(str_random(10)),
            'course' => '42',
            'nation' => 'kinh',
            'tel' => $faker->phoneNumber,
            'email' => $faker->email,
            'address' => $faker->address,
            'birth' => '2000-01-01',
            'gender' => 'nam',
            'family_tel' => $faker->phoneNumber,
            'family_address' => $faker->address,
            'status_id' => 1,
            'ward_id' => 1,
            ]);
        }
    }
}
