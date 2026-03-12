<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;


Route::inertia('/', 'Dashboard/Dashboard');
Route::prefix('task')->group(function () {
    Route::inertia('/', 'Task/Task');
    Route::inertia('/create-task', 'Task/CreateTask');
});

Route::controller(DepartmentController::class)->group(function () {
    Route::get('/department', 'index');
    Route::post('/add-department', 'addDepartment');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/add-user', 'addUser');
});






