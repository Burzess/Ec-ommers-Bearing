<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Here you would typically send an email or save to database
        // For now, we'll just redirect back with success message

        // You can uncomment and configure this when you have mail setup:
        /*
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->from($request->email, $request->name)
                 ->to('admin@asianbearindo.com')
                 ->subject('Contact Form: ' . $request->subject);
        });
        */

        return back()->with('success', 'Terima kasih! Pesan Anda telah dikirim. Kami akan menghubungi Anda segera.');
    }
}