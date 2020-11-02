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
        $developer = Staff::updateOrCreate(
            [
                'id' => 2
            ],
            [
                'username'       => 'Developer',
                'email'          => 'developer@example.com',
                'password'       => bcrypt('password'),
                'locale'         => 'ja',
                'remember_token' => null,
            ]
        );
        $user = Staff::updateOrCreate(
            [
                'id' => 3
            ],
            [
                'username'       => 'User',
                'email'          => 'user@example.com',
                'password'       => bcrypt('password'),
                'locale'         => 'ja',
                'remember_token' => null,
            ]
        );
        $developer->hasRole(2) or $developer->roles()->attach(2);
        $user->hasRole(3) or $user->roles()->attach(3);

        if (Staff::count() < 100) {
            Staff::factory()->count(100)->create();
        }
    }
}
