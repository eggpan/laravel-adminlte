<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleEditRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * ロール一覧の表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showList()
    {
        $roles = Role::paginate();
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * ロールのパーミッション編集フォーム表示
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showEditForm(string $id)
    {
        if ($id === '1') {
            return back_with_error(__('message.cant_edit_admin_role'));
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

    /**
     * ロールのパーミッション編集実行
     *
     * @param string $id
     * @param RoleEditRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(string $id, RoleEditRequest $request)
    {
        if ($id === '1') {
            return redirect_with_error('admin.role', __('message.cant_edit_admin_role'));
        }
        $role = Role::find($id);
        if (is_null($role)) {
            return redirect_with_error('admin.role', __('message.record_not_exist', ['id' => $id]));
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

    /**
     * ロール情報の表示
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view(string $id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return back_with_not_found($id);
        }

        return view('admin.role.view', ['role' => $role]);
    }
}
