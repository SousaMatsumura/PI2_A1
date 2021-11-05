<?php

namespace App\Http\Controllers\Secretary\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('secretary.dashboard.index');
    }
}
