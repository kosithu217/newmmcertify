<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Certificate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    
public function uploadCertificateLogo(Request $request)
{
    $request->validate([
        'certificate_logo' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        'certificate_id' => 'required|exists:certificates,id',
    ]);

    $certificate = Certificate::findOrFail($request->certificate_id);

    // Generate a unique filename
    $filename = 'certificate_logo_' . time() . '.' . $request->file('certificate_logo')->getClientOriginalExtension();

    // Define absolute path to public_html/storage/certificates/images/certificate_logos
    $destinationPath = base_path('public_html/storage/certificates/images/certificate_logos');

    // Create directory if it doesn't exist
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // Move uploaded file
    $request->file('certificate_logo')->move($destinationPath, $filename);

    // Save relative public URL path in database
    $relativePath = 'storage/certificates/images/certificate_logos/' . $filename;
    $certificate->certificate_logo = $relativePath;
    $certificate->save();

    return response()->json([
        'message' => 'Certificate logo saved.',
        'path' => asset($relativePath)
    ]);
}



    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    public function showRegistrationForm1()
    {
        return view('auth.register1');
    }

    /**
     * Handle registration requests.
     */
    public function register(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('employer');

        // Log the user in
        // auth()->login($user);
        
        $url = url("/verify/".base64_encode($user->id)."/".base64_encode($user->created_at));
        
        $details = [
            'title' => 'Verification mail from MMCertify',
            'body' => '<a href="'. $url .'">Please click to verify your mail</a>'
        ];
    
        Mail::send('emails.mail_code', $details, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verification');
        });

        // Redirect to the home page or any other page
        return redirect('/login')->with('success', "A verification mail has been sent to $user->email. Please check your email and click the verify.");
    }
    
    public function registerUni(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'reg_number' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'reg_number' => $request->reg_number,
            'contact_name' => $validated['contact_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('user');

        // Log the user in
        // auth()->login($user);
        
        $url = url("/verify/".base64_encode($user->id)."/".base64_encode($user->created_at));
        
        $details = [
            'title' => 'Verification mail from MMCertify',
            'body' => '<a href="'. $url .'">Please click to verify your mail</a>'
        ];
    
        Mail::send('emails.mail_code', $details, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verification');
        });

        // Redirect to the home page or any other page
        return redirect('/login')->with('success', "A verification mail has been sent to $user->email. Please check your email and click the verify.");
    }
    
    public function verify($id, $c){
        $user = User::find(base64_decode($id));
        
        if($user){
            if($user->created_at == base64_decode($c)){
                $user->email_verified_at = Carbon::now();
                $user->update();
                
                return redirect('/login')->with('success', "$user->email has been verified and please wait to approve from admin to get more access.");
            }
        }
        
        return redirect('/');
    }
    
    public function resetPassword(){
        return view('auth.reset_password');
    }
    
    public function resetPasswordSubmit(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect('/')->with('error', "$request->email not found.");
        }
        
        $url = url("/reset-password/".base64_encode($user->id)."/".base64_encode($user->created_at));
        
        $details = [
            'title' => 'Password reset mail from MMCertify',
            'body' => '<a href="'. $url .'">Please click to reset your password</a>'
        ];
    
        Mail::send('emails.mail_code', $details, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verification');
        });

        // Redirect to the home page or any other page
        return redirect('/login')->with('success', "A verification mail has been sent to $user->email. Please check your email and click the verify.");
    }
    
    public function verifyReset($id, $c){
        $user = User::find(base64_decode($id));
        
        if($user){
            if($user->created_at == base64_decode($c)){
                return view('auth.reset_update_password', compact('user'));
            }
        }
        
        return redirect('/');
    }
    
    public function updatePassword(Request $request){
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::find($request->id);
        
        $user->password = Hash::make($validated['password']);
        
        $user->update();
        
        return redirect('/login')->with('success', "Your password has been updated.");
    }
}
