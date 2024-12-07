<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function user()
    {
        return view('Dashboard.DashboardUser');  // Ensure this path matches your actual view path
    }

    
    public function admin()
    {
        return view('Dashboard.DashboardAdmin');  // Ensure this path matches your actual view path
    }
}

