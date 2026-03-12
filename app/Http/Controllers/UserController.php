<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Department;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $department = Department::all();

        return Inertia::render('Users/Users', [
            'users' => $users,
            'department' => $department
        ]);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|email',
            'department' => 'required|integer|exists:departments,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department
        ]);
    }
}
