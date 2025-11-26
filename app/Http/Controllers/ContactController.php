<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function send(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        // Send mail
        Mail::to("payerrony@gmail.com")->send(new ContactMail($req->all()));

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!'
        ]);
    }
}
