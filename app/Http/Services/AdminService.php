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
}
