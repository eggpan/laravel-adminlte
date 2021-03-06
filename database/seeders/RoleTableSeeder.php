<?php

namespace Database\Seeders;

use App\Import\CsvImporter;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importer = new CsvImporter();
        $importer->load('roles.csv', Role::class);
    }
}
