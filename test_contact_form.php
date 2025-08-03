<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing contact form submission...\n";

try {
    // Simulate the contact form data
    $request = new \Illuminate\Http\Request();
    $request->merge([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'message' => 'This is a test message from the contact form.'
    ]);

    // Create controller instance
    $controller = new \App\Http\Controllers\Auth\LoginController();
    
    // Test the validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);
    
    echo "✅ Validation passed!\n";
    
    // Test email sending
    $details = [
        'title' => "Contact Us Message from {$request->name}({$request->email}).",
        'body' => $request->message,
    ];

    Illuminate\Support\Facades\Mail::send('emails.mail_code', $details, function ($message) {
        $message->to('luisluistun@gmail.com')
                ->subject('Contact Us Mail');
    });

    echo "✅ Email sent successfully!\n";
    echo "✅ Contact form is working properly!\n";
    
} catch (Exception $e) {
    echo "❌ Contact form test failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "Test completed!\n";