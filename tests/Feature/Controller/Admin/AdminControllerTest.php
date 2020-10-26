<?php

namespace Tests\Feature\Controller\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->admin, 'admin');
    }

    public function testAdminユーザー一覧の表示()
    {
        $response = $this->get(route('admin.admin'));

        $response
            ->assertViewIs('admin.admin.index');
    }

    public function testAdminユーザー新規作成の表示()
    {
        $response = $this->get(route('admin.admin.create'));

        $response
            ->assertViewIs('admin.admin.create');
    }

    public function testAdminユーザー新規作成のPOST成功()
    {
        $response = $this->post(
            route('admin.admin.create'),
            [
                'email' => $this->faker->safeEmail,
                'username' =>  $this->faker->name,
                'locale' => 'ja',
                'password' => 'hogehoge',
                'password_confirmation' => 'hogehoge',
            ]
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.admin'));
    }

    public function testAdminユーザー参照()
    {
        $this->get(
            route('admin.admin.view', ['id' => $this->admin->id])
        )
        ->assertViewIs('admin.admin.view');
    }

    public function testAdminユーザー編集()
    {
        $this->get(
            route('admin.admin.edit', ['id' => $this->admin->id])
        )
        ->assertViewIs('admin.admin.edit');
    }

    public function testAdminユーザー編集のPOST成功()
    {
        $response = $this->put(
            route('admin.admin.edit', ['id' => $this->admin->id]),
            [
                'email' => $this->faker->safeEmail,
                'username' =>  $this->faker->name,
                'locale' => 'ja',
                'password' => 'hogehoge',
                'password_confirmation' => 'hogehoge',
            ]
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.admin'));
    }

    public function testAdminユーザー削除()
    {
        $response = $this->delete(
            route('admin.admin.delete', ['id' => $this->admin->id])
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.admin'));
        $deltedAdmin = Admin::withTrashed()->find($this->admin->id);
        $this->assertNotNull($deltedAdmin->deleted_at);
    }

    public function testAdminユーザー復元()
    {
        $this->admin->delete();
        $response = $this->get(
            route('admin.admin.restore', ['id' => $this->admin->id])
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.admin'));
        $deltedAdmin = Admin::withTrashed()->find($this->admin->id);
        $this->assertNull($deltedAdmin->deleted_at);
    }
}
