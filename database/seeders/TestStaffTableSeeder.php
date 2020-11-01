<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class TestStaffTableSeeder extends Seeder
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
                'id' => 2
            ],
            [
                'username'       => 'Developer',
                'email'          => 'developer@example.com',
                'password'       => bcrypt('password'),
                'role_id'        => 2,
                'locale'         => 'ja',
                'remember_token' => null,
            ]
        );
        Staff::updateOrCreate(
            [
                'id' => 3
            ],
            [
                'username'       => 'User',
                'email'          => 'user@example.com',
                'password'       => bcrypt('password'),
                'role_id'        => 3,
                'locale'         => 'ja',
                'remember_token' => null,
            ]
        );
        if (Staff::count() < 100) {
            Staff::factory()->count(100)->create();
        }
    }
}
