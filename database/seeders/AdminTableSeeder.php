<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'           => 'Adminstrator',
            'email'          => 'admin@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
