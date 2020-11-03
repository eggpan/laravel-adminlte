<?php

namespace Database\Seeders;

use App\Import\CsvImporter;
use App\Models\StaffRole;
use Illuminate\Database\Seeder;

class StaffRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importer = new CsvImporter();
        $importer->load('staff_roles.csv', StaffRole::class);
    }
}
