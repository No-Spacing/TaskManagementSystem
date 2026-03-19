<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Inertia\Inertia;

class TaskController extends Controller
{
    public function Index () {
        return Inertia::render('Task/Task');
    }

    public function CreateTask () {
        $users = User::select(['id', 'name'])->get();
        return Inertia::render('Task/CreateTask',['users' => $users]);
    }

    public function AddTask (Request $request) {
        $request->validate([
            'title' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'description' => 'required|regex:/^[A-Za-z0-9 ]+$/',
        ]);

        $ids = array_column($request->members, 'id'); 

        $record = Record::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $record->callpoints()->attach($ids);  

    }
}
