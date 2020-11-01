<?php

namespace Database\Seeders;

use App\Import\CsvImporter;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importer = new CsvImporter();
        $importer->load('permissions.csv', Permission::class);
    }
}
