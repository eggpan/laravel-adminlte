<?php

namespace Tests;

use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('StaffRoleTableSeeder');
        $this->seed('RoleTableSeeder');
        $this->seed('PermissionTableSeeder');
        $this->seed('RolePermissionTableSeeder');
        $this->seed('RolePermissionTableSeeder');
        $this->admin = Staff::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->developer = Staff::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->user = Staff::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->developer->roles()->attach(2);
        $this->user->roles()->attach(3);
    }
}
