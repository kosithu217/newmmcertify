<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login requests.
     */
    public function login(Request $request)
    {
        // Validate login input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // Redirect to the intended page or home
            return redirect()->intended('/home');
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    /**
     * Handle logout requests.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
    public function contactSubmitForm(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        
        $details = [
            'title' => "Contact Us Message from $request->name($request->email).",
            'body' => $request->message,
        ];
    
        Mail::send('emails.mail_code', $details, function ($message) {
            $message->to('luisluistun@gmail.com')// contact us message receiver mail
                    ->subject('Contact Us Mail');
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
    
}
