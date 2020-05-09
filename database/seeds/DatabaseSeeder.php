<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RouteSeeder::class);

        $data = array([
            'code' => 'b1605229',
            'name' => 'Lê Minh Nghĩa',
            'password' => bcrypt('123123123'),
            'course' => '42',
            'nation' => 'kinh',
            'tel' => '0826903960',
            'email' => 'nghiab1605229@gmail',
            'address' => 'ktx',
            'birth' => '1998-01-01',
            'gender' => 'nam',
            'family_tel' => 'A12',
            'family_address' => '12',
            'status_id' => 1,
            'ward_id' => 1,
        ]);
        DB::table('users')->insert($data);
    }
}