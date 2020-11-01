<?php

namespace Tests\Feature\Controller\Admin;

use App\Models\Staff;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaffControllerTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->developer, 'staff');
    }

    public function testAdminユーザー一覧の表示()
    {
        $response = $this->get(route('admin.staff'));

        $response
            ->assertViewIs('admin.staff.index');
    }

    public function testUser権限でのAdminユーザー一覧の表示()
    {
        $this->actingAs($this->user, 'staff');
        $response = $this->get(route('admin.staff'));

        $response
            ->assertStatus(302);
    }

    public function testAdminユーザー新規作成の表示()
    {
        $response = $this->get(route('admin.staff.create'));

        $response
            ->assertViewIs('admin.staff.create');
    }

    public function testAdminユーザー新規作成のPOST成功()
    {
        $response = $this->post(
            route('admin.staff.create'),
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
            ->assertRedirect(route('admin.staff'));
    }

    public function testAdminユーザー参照()
    {
        $this->get(
            route('admin.staff.view', ['id' => $this->admin->id])
        )
        ->assertViewIs('admin.staff.view');
    }

    public function testAdminユーザー編集()
    {
        $this->get(
            route('admin.staff.edit', ['id' => $this->admin->id])
        )
        ->assertViewIs('admin.staff.edit');
    }

    public function testAdminユーザー編集のPOST成功()
    {
        $response = $this->put(
            route('admin.staff.edit', ['id' => $this->admin->id]),
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
            ->assertRedirect(route('admin.staff'));
    }

    public function testAdminユーザー削除()
    {
        $response = $this->delete(
            route('admin.staff.delete', ['id' => $this->admin->id])
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.staff'));
        $deltedAdmin = Staff::withTrashed()->find($this->admin->id);
        $this->assertNotNull($deltedAdmin->deleted_at);
    }

    public function testAdminユーザー復元()
    {
        $this->admin->delete();
        $response = $this->get(
            route('admin.staff.restore', ['id' => $this->admin->id])
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.staff'));
        $deltedAdmin = Staff::withTrashed()->find($this->admin->id);
        $this->assertNull($deltedAdmin->deleted_at);
    }
}
