<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;

use App\Models\User;
use App\Models\Department;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['department', 'status'])->get();
        $department = Department::all();
        $roles = Role::all();

        return Inertia::render('Users/Users', [
            'users' => $users,
            'department' => $department,
            'roles' => $roles
        ]);
    }

    public function AddUser(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|email|unique:users',
            'department' => 'required|integer|exists:departments,id',
            'password' => 'required|string|min:8',
            'role' => 'required|integer|exists:roles,id',
        ]);

        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'department_id' => $validate['department'],
            'password' => Hash::make($validate['password']),
            'role_id' => $validate['role'],
            'status_id' => 3
        ]);
    }
}
