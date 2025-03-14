<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class SmtpTestController extends Controller
{
    public function sendTestEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            Mail::to($request->email)->send(new TestMail());

            return redirect()->back()->with('success', 'Test email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }
}
