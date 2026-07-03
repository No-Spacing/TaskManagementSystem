<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function Index () {
        $users = User::limit(5);

        return inertia::render('Dashboard/Dashboard')
        ->with('title', 'Welcome to Dashboard')
        ->with(['users' => $users]);
    }
}
