<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('auth.admin:admin');
    }
    public function index()
    {
        dd('后台首页，当前用户名：');
    }
}
