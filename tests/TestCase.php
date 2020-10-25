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
            'email'    => $this->faker->unique()->email,
            'name'     => $this->faker->name,
            'password' => bcrypt('password'),
        ]);
    }
}
