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

        $query = Ticket::with(['department', 'status', 'user']);

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

    public function SubmitTicket (Request $request) {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        $ticket = Ticket::find($request->ticket_id);

        if ($ticket->status_id === 2) {
            return back()->withErrors(['message' => 'This item is already finished and cannot be updated.']);
        }
 
        $ticket->status_id = $validated['status'];

        if($ticket->isDirty('status_id')) {
            
            $ticket->submitted_by = Auth::id();
            $ticket->save();
            return back()->with('message', 'Ticket submission was successful');
        }else {
            return back()->with('message', 'Nothing has changed');
        }
    }
}
