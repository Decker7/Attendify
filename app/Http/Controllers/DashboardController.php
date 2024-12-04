<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function user()
    {
        return view('Dashboard.DashboardUser');  // Ensure this path matches your actual view path
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function admin()
    {
        return view('Dashboard.DashboardAdmin');  // Ensure this path matches your actual view path
    }
}

