<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

class SettingController extends Controller
{
    public function Index () {
        return Inertia::render('Setting/Settings');
    }
}
