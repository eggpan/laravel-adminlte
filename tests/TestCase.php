<?php

namespace Tests;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'role_id'  => 1,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->developer = Admin::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'role_id'  => 2,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->user = Admin::create([
            'email'    => $this->faker->unique()->safeEmail,
            'username' => $this->faker->name,
            'role_id'  => 3,
            'locale'   => 'ja',
            'password' => bcrypt('password'),
        ]);
        $this->seed('RoleTableSeeder');
        $this->seed('PermissionTableSeeder');
        $this->seed('RolePermissionTableSeeder');
        $this->seed('RolePermissionTableSeeder');
    }
}
