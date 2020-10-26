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

    public function showList()
    {
        $admins = Admin::withTrashed()->paginate();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    public function showCreateForm()
    {
        return view('admin.admin.create');
    }

    public function create(AdminCreateRequest $request)
    {
        $this->adminService->create($request);

        return redirect()->route('admin.admin');
    }

    public function showEditForm($id)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }

        return view('admin.admin.edit', ['admin' => $admin]);
    }

    public function edit($id, AdminEditRequest $request)
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

    public function view($id)
    {
        $admin = Admin::withTrashed()->find($id);
        if (is_null($admin)) {
            return $this->adminService->redirectNotExist($id);
        }

        return view('admin.admin.view', ['admin' => $admin]);
    }

    public function delete($id)
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

    public function restore($id)
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
