<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Department;
use App\Models\Ticket;

use Inertia\Inertia;

class TicketController extends Controller
{
    public function Index (Request $request) {
        $tickets = null;

        $query = Ticket::with(['department', 'status']);

        if ($request->filter_by === 'Requests') {
            $query->where('created_by', Auth::id());
        } 
        elseif ($request->filter_by === 'Tickets') {
            $query->where('assigned_department_id', Auth::user()->department_id);
        } 
        else {
            $query->where(function ($q) {
                $q->where('assigned_department_id', Auth::user()->department_id)
                ->orWhere('created_by', Auth::id());
            });
        }

        $tickets = $query->get();
        
        $departments = Department::all();
        return Inertia::render('Ticket/Tickets')
        ->with([
            'departments' => $departments,
            'tickets' => $tickets
        ]);
    } 

    public function AddTicket (Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department' => 'required',
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'assigned_department_id' => $validated['department'],
            'created_by' => Auth::id(),
            'status_id' => 1
        ]);
    }
}
