<?php

namespace App\Http\Controllers\Admin\Dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.Page.dashboard.index');
    }
}
