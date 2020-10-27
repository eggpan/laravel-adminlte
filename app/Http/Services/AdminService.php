<?php

namespace App\Http\Services;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminService
{
    /**
     * 管理者ユーザーの新規作成
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\Admin
     */
    public function create(Request $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        return Admin::create($validated);
    }

    /**
     * 管理者ユーザーのデータ更新
     *
     * @param \App\Models\Admin $admin
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update(Admin $admin, Request $request)
    {
        $validated = $request->validated();
        if (is_null($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }
        return $admin->update($validated);
    }

    /**
     * フラッシュメッセージと共に一覧ページへ戻す
     *
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectNotExist(string $id)
    {
        return redirect()
            ->route('admin.admin')
            ->withErrors(['message' => __('message.user_not_exist', ['id' => $id])]);
    }
}
