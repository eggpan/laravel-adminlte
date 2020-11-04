<?php

namespace Tests\Feature\Controller\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->developer, 'staff');
    }

    public function testロール一覧の表示()
    {
        $response = $this->get(route('admin.role'));

        $response
            ->assertStatus(200)
            ->assertViewIs('admin.role.index');
    }

    public function testロール編集()
    {
        $response = $this->get(route('admin.role.edit', ['id' => 2]));
        $response
            ->assertViewIs('admin.role.edit');
    }

    public function testロール編集_Administrator()
    {
        $this->get(route('admin.role'));
        $response = $this->get(route('admin.role.edit', ['id' => 1]));
        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.role'));
    }

    public function testロール編集のPOST成功()
    {
        $this->get(route('admin.role.edit', ['id' => 2]));
        $response = $this->put(
            route('admin.role.edit.put', ['id' => 2]),
            [
                'permissions' => [
                    2, 3, 4, 5, 6
                ]
            ]
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.role'));
    }

    public function testロール編集のPOST失敗()
    {
        // バリデーションエラー
        $this->get(route('admin.role.edit', ['id' => 2]));
        $response = $this->put(
            route('admin.role.edit.put', ['id' => 2]),
            [
                'permissions' => [
                    'hogehoge',
                    'fugafuga',
                ]
            ]
        );
        $errorMessage = session('errors')->get('permissions.1')[0];
        $this->assertEquals($errorMessage, __('validation.in', ['attribute' => 'permissions.1']));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.role.edit', ['id' => 2]));

        // Administratorの編集
        $this->get(route('admin.role.edit', ['id' => 2]));
        $response = $this->put(
            route('admin.role.edit.put', ['id' => 1]),
            [
                'permissions' => null
            ]
        );
        $response->assertSessionHasErrors('message');
        $errorMessage = session('errors')->first();
        $this->assertEquals($errorMessage, __('message.cant_edit_admin_role'));

        // 存在しないIDのPOST
        $this->get(route('admin.role.edit', ['id' => 2]));
        $response = $this->put(
            route('admin.role.edit.put', ['id' => 0]),
            [
                'permissions' => null
            ]
        );
        $response->assertSessionHasErrors('message');
        $errorMessage = session('errors')->first();
        $this->assertEquals($errorMessage, __('message.record_not_exist', ['id' => '0']));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.role'));
    }
}
