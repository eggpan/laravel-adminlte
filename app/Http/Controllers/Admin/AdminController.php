<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminEditRequest;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    /**
     * 管理者ユーザー一覧の表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showList()
    {
        $admins = Admin::withTrashed()->paginate();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    /**
     * 管理者ユーザーの新規作成フォーム表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateForm()
    {
        return view('admin.admin.create');
    }

    /**
     * 管理者ユーザーの新規作成実行
     *
     * @param AdminCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(AdminCreateRequest $request)
    {
        $this->adminService->create($request);

        return redirect()->route('admin.admin');
    }

    /**
     * 管理者ユーザーの編集フォーム表示
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showEditForm(string $id)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }

        return view('admin.admin.edit', ['admin' => $admin]);
    }

    /**
     * 管理者ユーザーのデータ編集実行
     *
     * @param string $id
     * @param AdminEditRequest $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id, AdminEditRequest $request)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }

        $this->adminService->update($admin, $request);

        return redirect()
            ->route('admin.admin')
            ->with(['message.success' => __('message.updated_data')]);
    }

    /**
     * 管理者ユーザー情報の表示
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view(string $id)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }

        return view('admin.admin.view', ['admin' => $admin]);
    }

    /**
     * 管理者ユーザーの論理削除
     *
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(string $id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }
        $admin->delete();

        return redirect()
            ->route('admin.admin')
            ->with(['message.success' => __('message.deleted_data')]);
    }

    /**
     * 管理者ユーザーの復元
     *
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }
        $admin->restore();

        return redirect()
            ->route('admin.admin')
            ->with(['message.success' => __('message.restore_data')]);
    }
}
