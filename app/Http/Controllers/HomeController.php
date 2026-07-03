<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function Index() {
        return Inertia::render('Home/Home');
    }

    public function SubmitInquiry (Request $request) {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'coemail' => 'required',
            'organization' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'message' => 'required',
        ]);
    } 
}
