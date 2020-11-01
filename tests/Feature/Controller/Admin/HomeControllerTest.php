<?php

namespace Tests\Feature\Controller\Admin;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminホームへのアクセス()
    {
        $response = $this->get(route('admin.home'));
        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }

    public function testAdminログイン時ホームへのアクセス()
    {
        $response = $this->actingAs($this->admin, 'staff')->get(route('admin.home'));
        $response
            ->assertStatus(200)
            ->assertViewIs('admin.home')
            ->assertSeeInOrder([
                '<a href="' . route('admin.logout'),
                'ログアウト',
                '</a>',
                '<a href="' . route('admin.home'),
                config('app.name'),
                '</a>',
            ], false);
    }
}
