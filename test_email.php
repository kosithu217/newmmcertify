<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing email configuration...\n";

try {
    // Test email configuration
    $details = [
        'title' => 'Test Email from MM Certify',
        'body' => 'This is a test email to check if the email configuration is working properly.'
    ];

    Illuminate\Support\Facades\Mail::send('emails.mail_code', $details, function ($message) {
        $message->to('luisluistun@gmail.com')
                ->subject('Test Email - MM Certify');
    });

    echo "✅ Email sent successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Email sending failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "Test completed!\n";