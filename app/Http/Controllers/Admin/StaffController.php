<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffCreateRequest;
use App\Http\Requests\StaffEditRequest;
use App\Http\Services\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct()
    {
        $this->staffService = new StaffService();
    }

    /**
     * 管理者ユーザー一覧の表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showList()
    {
        $admins = Staff::withTrashed()->paginate();
        return view('admin.staff.index', ['admins' => $admins]);
    }

    /**
     * 管理者ユーザーの新規作成フォーム表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateForm()
    {
        return view('admin.staff.create');
    }

    /**
     * 管理者ユーザーの新規作成実行
     *
     * @param StaffCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(StaffCreateRequest $request)
    {
        $this->staffService->create($request);

        return redirect()->route('admin.staff');
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
        $admin = Staff::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->staffService->redirectNotExist($id);
        }

        return view('admin.staff.edit', ['admin' => $admin]);
    }

    /**
     * 管理者ユーザーのデータ編集実行
     *
     * @param string $id
     * @param StaffEditRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(string $id, StaffEditRequest $request)
    {
        $admin = Staff::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->staffService->redirectNotExist($id);
        }

        $this->staffService->update($admin, $request);

        return redirect()
            ->route('admin.staff')
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
        $admin = Staff::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->staffService->redirectNotExist($id);
        }

        return view('admin.staff.view', ['admin' => $admin]);
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
        $admin = Staff::find($id);
        if (is_null($admin)) {
            return $this->staffService->redirectNotExist($id);
        }
        $admin->delete();

        return redirect()
            ->route('admin.staff')
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
        $admin = Staff::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->staffService->redirectNotExist($id);
        }
        $admin->restore();

        return redirect()
            ->route('admin.staff')
            ->with(['message.success' => __('message.restore_data')]);
    }
}
