<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $nonAdminCount = User::where('role', '!=', 'admin')->count();

        return view('dashboard', compact('userCount', 'adminCount', 'nonAdminCount'));
    }
}
