<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


Route::inertia('/', 'Dashboard/Dashboard');


Route::prefix('task')->group(function () {
    Route::controller(TaskController::class)->group(function () {
        Route::get('/', 'Index');
        Route::get('/create-task', 'CreateTask');
        Route::post('/add-task', 'AddTask');
    });
});

Route::controller(DepartmentController::class)->group(function () {
    Route::get('/department', 'index');
    Route::post('/add-department', 'addDepartment');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/add-user', 'addUser');
});






