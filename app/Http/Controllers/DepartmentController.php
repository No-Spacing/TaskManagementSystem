<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function index () {
        $departments = Department::with('users')->get();
        return Inertia::render('Department/Department',['departments' => $departments]);
    }

    public function addDepartment (Request $request) {
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/'
        ]);

        Department::create($request->all());
    }
}
