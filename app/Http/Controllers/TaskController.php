<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Inertia\Inertia;

class TaskController extends Controller
{
    public function Index() {
        return Inertia::render('Task/Task');
    }

    public function CreateTask() {
        $users = User::all();
        return Inertia::render('Task/CreateTask',['users' => $users]);
    }
}
