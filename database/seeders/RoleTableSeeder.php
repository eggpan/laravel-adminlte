<?php

namespace Database\Seeders;

use App\Import\CsvImporter;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
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
        $importer->load('permissions.csv', Permission::class);
        $importer->load('roles_permissions.csv', RolePermission::class);
    }
}
