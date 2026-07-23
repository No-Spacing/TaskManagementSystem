<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\Inquired;
use App\Mail\InquiryMail;


class HomeController extends Controller
{
    public function Index() {
        return Inertia::render('Home/Home');
    }

    public function SubmitInquiry (Request $request) {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:inquireds',
            'confirm_email' => 'required|confirmed:email',
            'organization' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'message' => 'required',
        ]);

        Inquired::create($validated);

        Mail::to('info@pmcgroup.com')->send(new InquiryMail($validated));

        return back()->with('message', 'Thank you! Your inquiry has been submitted successfully. We’ll get back to you soon.');
    } 


}
