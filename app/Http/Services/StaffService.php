<?php

namespace App\Http\Services;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffService
{
    /**
     * 管理者ユーザーの新規作成
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\Staff
     */
    public function create(Request $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        return Staff::create($validated);
    }

    /**
     * 管理者ユーザーのデータ更新
     *
     * @param \App\Models\Staff $admin
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update(Staff $admin, Request $request)
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
            ->route('admin.staff')
            ->withErrors(['message' => __('message.user_not_exist', ['id' => $id])]);
    }
}
