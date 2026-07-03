<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function Index () {
        $departments = Department::with('users')->get();
        return Inertia::render('Department/Departments',['departments' => $departments]);
    }

    public function AddDepartment (Request $request) {
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9 ]+$/'
        ]);

        Department::create($request->all());
    }
}
