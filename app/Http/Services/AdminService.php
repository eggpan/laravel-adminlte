<?php

namespace App\Http\Services;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminService
{
    public function create(Request $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        return Admin::create($validated);
    }

    public function update($admin, $request)
    {
        $validated = $request->validated();
        if (is_null($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }
        return $admin->update($validated);
    }

    public function redirectNotExist($id)
    {
        return redirect()
            ->route('admin.admin')
            ->withErrors(['message' => __('message.user_not_exist', ['id' => $id])]);
    }
}
