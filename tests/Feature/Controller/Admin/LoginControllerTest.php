<?php

namespace Tests\Feature\Controller\Admin;

use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminログインページへのアクセス()
    {
        $response = $this->get(route('admin.login'));
        $response
            ->assertStatus(200)
            ->assertViewIs('admin.login')
            ->assertSeeInOrder([
                '<form action="' . route('admin.login.post') . '" method="POST">',
                '<input name="email"',
                '<input name="password"',
                '<input name="remember"',
            ], false);

    }

    public function testAdminログイン時ログインページへのアクセス()
    {
        $response = $this
            ->actingAs($this->admin, 'admin')
            ->get(route('admin.login'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.home'));
    }

    public function testAdminログイン成功()
    {
        $this->post(route('admin.login.post'), [
                'email' => $this->admin->email,
                'password' => 'password',
            ])
            ->assertStatus(302)
            ->assertRedirect(route('admin.home'));
    }

    public function testAdminログイン失敗()
    {
        $this->post(route('admin.login.post'), [
                'email' => $this->admin->email,
                'password' => 'hogehoge',
            ])
            ->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
}
