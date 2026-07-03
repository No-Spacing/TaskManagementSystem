<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;

use Inertia\Inertia;

class TicketController extends Controller
{
    public function Index () {
        $departments = Department::all();
        return Inertia::render('Ticket/Tickets')->with(['departments' => $departments]);
    } 

    public function AddTicket (Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department' => 'required',
            'date_needed' => 'required', 
        ]);

        
    }
}
