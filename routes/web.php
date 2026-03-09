<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/create-task', 'Task/CreateTask');
Route::inertia('/task', 'Task/Task');


