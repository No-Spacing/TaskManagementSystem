<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Department;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['department', 'status'])->get();
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
            'email' => 'required|email|unique:users',
            'department' => 'required|integer|exists:departments,id',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department,
            'password' => Hash::make(Str::random(12)),
            'status_id' => 3
        ]);
    }
}
