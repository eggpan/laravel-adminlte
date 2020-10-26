<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
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
        $admins = Admin::paginate();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    public function showCreateForm()
    {
        return view('admin.admin.create');
    }

    public function create(AdminCreateRequest $request)
    {
        if ($this->adminService->create($request)) {
            return redirect()->route('admin.admin');
        }
        return redirect()->route('admin.admin.create');
    }

    public function showEditForm($id)
    {
        $admin = Admin::find($id);
        return view('admin.admin.edit', ['admin' => $admin]);
    }

    public function view($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return redirect()
                ->route('admin.admin')
                ->withErrors(['message' => __('lang.user_not_exist', ['id' => $id])]);
        }
        return view('admin.admin.view', ['admin' => $admin]);
    }
}
