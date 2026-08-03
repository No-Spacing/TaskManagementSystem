<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\User;
use App\Models\Task;
use App\Models\UserTaskContent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Inertia\Inertia;

class TaskController extends Controller
{
    public function Index () {
        $tasks = Task::with(['status', 'users'])
        ->whereHas('users', function ($query) {
            $query->where('users.id', auth()->id());
        })
        ->with(['status', 'users'])
        ->get();

        return Inertia::render('Task/Task', ['tasks' => $tasks]);
    }

    public function CreateTask () {
        $users = User::select(['id', 'name'])->get();
        $departments = Department::with(['users:id,department_id,name'])
        ->select(['id', 'name'])
        ->get();

        return Inertia::render('Task/CreateTask', ['users' => $users, 'departments' => $departments]);
    }

    public function AddTask (Request $request) {

        $request->validate([
            'title' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'description' => 'required|regex:/^[A-Za-z0-9 ]+$/',
            'members' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    // 1. Check if any member is missing an ID
                    $hasInvalidMember = collect($value)->contains(function ($member) {
                        return empty($member['id']);
                    });

                    if ($hasInvalidMember) {
                        return $fail('Please select or add a member for all fields.');
                    }

                    // 2. Extract all IDs and check for duplicates
                    $memberIds = collect($value)->pluck('id')->filter();
                    
                    if ($memberIds->count() !== $memberIds->unique()->count()) {
                        return $fail('You cannot select the same member more than once.');
                    }
                },
            ],
        ]);

        $ids = array_column($request->members, 'id'); 

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'steps' => 1,
            'created_by' => Auth::user()->id,
            'status_id' => 1
        ]);

        $task->users()->attach($ids, [
            'content' => null,
            'file' => null,
            'status_id' => 1,
        ]);

    }

    public function SubmitTask(Request $request) {
        $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png,gif',
            'content' => 'required',
        ], [
            'file.required' => 'Please upload a file',
            'file.mimes' => 'Only PDF or image files are allowed',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        // Default disk
        $path = Storage::disk('public')->putFileAs('task_files', $file, $filename);

        Auth::user()->tasks()->updateExistingPivot($request->task_id, [
            'content' => $request->input('content'),
            'file'    => $path,
            'status_id' => 2,
        ]);

        return redirect('/task');
    }
}
