<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Index');
    Route::post('/submit-inquiry', 'SubmitInquiry');
});

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'Index');
        Route::post('submit-login', 'SubmitLogin');
    });
    
});

Route::middleware(['auth-group'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'Index');
    });

    Route::prefix('department')->group(function () {
        Route::controller(DepartmentController::class)->group(function () {
            Route::get('/', 'Index');
            Route::post('add-department', 'AddDepartment');
        });
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'Index');
    });


    Route::prefix('task')->group(function () {
        Route::controller(TaskController::class)->group(function () {
            Route::get('/', 'Index');
            Route::get('/create-task', 'CreateTask'); // Create task page
            Route::post('/add-task', 'AddTask'); // Add task to database
            Route::post('/submit-task', 'SubmitTask'); // Submission of task for those people who's assigned to that task
        });
    });

    Route::prefix('ticket')->group(function () {
        Route::controller(TicketController::class)->group(function () {
            Route::get('/', 'Index');
            Route::post('/add-ticket', 'AddTicket'); // Add ticket to database
            Route::post('/submit-ticket', 'SubmitTicket');
        });
    });
        
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::post('/add-user', 'AddUser'); // Add user to database
    });

    Route::get('/logout', [AuthController::class, 'logout']);
});







