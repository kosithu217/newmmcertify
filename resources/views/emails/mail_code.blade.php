<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 25px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #2c3e50;
            margin: 0;
            padding: 0;
            font-size: 24px;
        }
        .content {
            padding: 10px 0;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ $title }}</h1>
        </div>
        
        <div class="content">
            <p>Dear Valued Users,</p>
            
            <p>Thank you for registering with <strong>www.mmcertify.com</strong> – your trusted partner for e-certificate issuing and verification.</p>
            
            <p>To get started, please verify your email address by clicking the link below:</p>
            
            <div style="text-align: center;">
                {!! $body !!}
            </div>
            
            <p>Sincerely yours,<br>
            <strong>MMCertify.com</strong> team</p>
        </div>
        
        <div class="footer">
            <p>© 2025 MMCertify. All rights reserved.</p>
            <p>If you did not create this account, please ignore this email.</p>
        </div>
    </div>
</body>
</html>
