<?php

namespace Database\Seeders;

use App\Import\CsvImporter;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $importer = new CsvImporter();
        $importer->load('roles_permissions.csv', RolePermission::class);
    }
}
