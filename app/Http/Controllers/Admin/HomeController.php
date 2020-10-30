<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View;

class HomeController extends Controller
{
    /**
     * ホーム画面の表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showDashboard()
    {
        return view('admin.home');
    }
}
