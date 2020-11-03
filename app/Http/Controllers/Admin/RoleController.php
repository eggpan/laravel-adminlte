<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showList()
    {
        $roles = Role::paginate();
        return view('admin.role.index', ['roles' => $roles]);
    }

    public function showEditForm(string $id)
    {
        if ($id === '1') {
            return redirect()
                ->back()
                ->withErrors(['message' => 'ID:1の権限は編集出来ません。']);
        }
        $role = Role::find($id);
        $permissions = Permission::where('name', '!=', 'superuser')->get();
        if (is_null($role)) {
            return back_with_not_found($id);
        }

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function edit(string $id, Request $request)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return back_with_not_found($id);
        }
        $role->touch();
        $newPermissions = $request->get('permissions');
        if (isset($newPermissions)) {
            foreach ($newPermissions as $permission) {
                RolePermission::updateOrCreate(
                    [
                        'role_id' => $id,
                        'permission_id' => $permission,
                    ],
                    [
                        'role_id' => $id,
                        'permission_id' => $permission,
                    ]
                );
            }
            RolePermission::where('role_id', $id)
                ->whereNotIn('permission_id', $newPermissions)
                ->delete();
        } else {
            RolePermission::where('role_id', $id)
                ->delete();
        }
        return redirect_with_success('admin.role', __('message.updated_record', ['id' => $id]));
    }

    public function view(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return back_with_not_found($id);
        }

        return view('admin.role.view', ['role' => $role]);
    }
}
