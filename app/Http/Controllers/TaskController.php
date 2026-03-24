<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Task;

use Inertia\Inertia;

class TaskController extends Controller
{
    public function Index () {
        $tasks = Task::with(['status', 'users'])->get();

        return Inertia::render('Task/Task', ['tasks' => $tasks]);
    }

    public function CreateTask () {
        $users = User::select(['id', 'name'])->get();
        return Inertia::render('Task/CreateTask', ['users' => $users]);
    }

    public function AddTask (Request $request) {
        $request->validate([
            'title' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'description' => 'required|regex:/^[A-Za-z0-9 ]+$/',
        ]);

        $ids = array_column($request->members, 'id'); 

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'steps' => 1,
            'created_by' => 1,
            'status_id' => 1
        ]);
        $task->users()->attach($ids, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
