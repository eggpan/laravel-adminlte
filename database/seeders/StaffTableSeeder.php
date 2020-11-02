<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'username'       => 'Adminstrator',
                'email'          => 'admin@example.com',
                'password'       => bcrypt('password'),
                'locale'         => 'ja',
                'remember_token' => Str::random(10),
            ]
        );
    }
}
