<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class TestAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate(
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
        Admin::updateOrCreate(
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
        if (Admin::count() < 100) {
            Admin::factory()->count(100)->create();
        }
    }
}
