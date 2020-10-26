<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestUserTableSeeder::class);
        $this->call(TestAdminTableSeeder::class);
    }
}
