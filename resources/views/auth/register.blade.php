<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MMCertify.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
           
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("{{ asset('uri_ifs___M_k8o0SNw4dgbLNtQIQhXcgDGtRdDqrLY-BrlYIYsO-Ek.webp') }}") center/cover no-repeat;
            opacity: 0.1;
            z-index: -1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .brand-header {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 1000;
        }

        .brand-logo {
            color: white;
            font-size: 28px;
            font-weight: 700;
            text-decoration: none;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .brand-logo:hover {
            color: #f8f9fa;
            transform: scale(1.05);
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .registration-wrapper {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            position: relative;
        }

        .registration-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        }

        .form-header {
            text-align: center;
            padding: 40px 40px 20px;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        }

        .welcome-text {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .form-title {
            color: #2d3748;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            background-color: #1877F2;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tab-container {
            display: flex;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 4px;
            margin: 20px 40px;
            position: relative;
        }

        .tab-button {
            flex: 1;
            padding: 12px 20px;
            background: transparent;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .tab-button.active {
            color: white;
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .form-container {
            padding: 0 40px 40px;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #4a5568;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            background: #ffffff;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: #ffffff;
        }

        .form-control.is-invalid {
            border-color: #e53e3e;
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
        }

        .invalid-feedback {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .password-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .terms-section {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }

        .terms-title {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .terms-content {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            height: 180px;
            overflow-y: auto;
            font-size: 12px;
            line-height: 1.5;
            color: #4a5568;
            margin-bottom: 16px;
        }

        .terms-content::-webkit-scrollbar {
            width: 6px;
        }

        .terms-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .terms-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .terms-checkbox input[type="checkbox"] {
            margin-top: 2px;
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .terms-checkbox label {
            font-size: 13px;
            color: #4a5568;
            line-height: 1.4;
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        @media (max-width: 768px) {
            .registration-wrapper {
                margin: 10px;
                border-radius: 16px;
            }

            .form-header,
            .form-container {
                padding: 30px 25px;
            }

            .tab-container {
                margin: 20px 25px;
            }

            .form-title {
                font-size: 24px;
            }

            .password-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .brand-header {
                top: 20px;
                left: 20px;
            }

            .brand-logo {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
@include('nav')

    <div class="main-container">
        <div class="registration-wrapper">
            <div class="form-header">
                <div class="welcome-text">
                    Please provide the required information below to create an academic or business institution account for issuing verifiable digital certificates on the MM Certify platform.
                </div>
                <h1 class="form-title">Account Registration</h1>
            </div>

            <div class="tab-container">
                
                <button class="tab-button d-none" onclick="switchTab('visitor')">
                    <i class="fas fa-user me-2"></i>Visitor / Employer
                </button>
            </div>

            <div class="form-container">
                <!-- Hidden Basic Form -->
                <div class="form-section" id="visitor-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="password-row">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="terms-section">
                            <div class="terms-title">Terms of Use and Privacy Policy</div>
                            <div class="terms-content">
                                <strong>TERMS OF USE</strong><br>
                                Welcome to MM Certify! By using our certificate and document verification services and platform, you agree to comply with and be bound by the following terms and conditions...<br><br>
                                <em>(Full Terms of Use & Privacy Policy available at <a href="{{ url('/terms-and-conditions') }}" target="_blank">this link</a>.)</em>
                            </div>
                            <div class="terms-checkbox">
                                <input class="accept-terms" type="checkbox" value="1" id="acceptTerms1">
                                <label for="acceptTerms1">
                                    By clicking, I accept the terms of use and privacy policy of this platform as may be applicable.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn register-btn" disabled>
                            <i class="fas fa-user-plus me-2"></i>Register Account
                        </button>

                        <div class="login-link">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Already have an account? Login
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Institution Registration Form -->
                <div class="form-section active" id="institution-form">
                    <form method="POST" action="{{ route('register-uni') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name1" class="form-label">Academic or Business Institution Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name1" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reg_number" class="form-label">Registration Number (if applicable)</label>
                            <input type="text" class="form-control @error('reg_number') is-invalid @enderror" id="reg_number" name="reg_number" value="{{ old('reg_number') }}">
                            @error('reg_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_name" class="form-label">Contact Person Name</label>
                            <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
                            @error('contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Contact Person Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Academic or Business Institution Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email1" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email1" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="password-row">
                            <div class="form-group">
                                <label for="password1" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation1" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation1" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="terms-section">
                            <div class="terms-title">Terms of Use and Privacy Policy</div>
                            <div class="terms-content">
                                <strong>TERMS OF USE</strong><br>
                                Welcome to MM Certify! By using our certificate and document verification services and platform, you agree to comply with and be bound by the following terms and conditions. Please read them carefully before using our services.<br><br>
                                By registering on MMCertify.com, you agree to the following:<br>
                                1. Eligibility: You must be an authorized representative of a recognized academic or business institution.<br>
                                2. Account Responsibility: You are responsible for maintaining the confidentiality of your account credentials and for all activities conducted under your account.<br>
                                3. Certificate Authenticity: You confirm that all certificates issued through the platform are genuine and accurate.<br><br>
                                <strong>Description of Services</strong><br>
                                MM Certify provides verification services to confirm the authenticity and integrity of educational and professional credentials. Our services are available to individuals, institutions, employers, and other organizations requiring credential validation.<br><br>
                                <strong>🔐 PRIVACY POLICY</strong><br>
                                At MM Verify, we are committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and safeguard your information when you use our certificate verification services and platform.<br><br>
                                <em>(Full Terms of Use & Privacy Policy available at <a href="{{ url('/terms-and-conditions') }}" target="_blank">this link</a>.)</em>
                            </div>
                            <div class="terms-checkbox">
                                <input class="accept-terms" type="checkbox" value="1" id="acceptTerms2">
                                <label for="acceptTerms2">
                                    By clicking, I accept the terms of use and privacy policy of this platform as may be applicable.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn register-btn" disabled>
                            <i class="fas fa-university me-2"></i>Register Institution
                        </button>

                        <div class="login-link">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Already have an account? Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Update tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Update form sections
            document.querySelectorAll('.form-section').forEach(section => section.classList.remove('active'));
            document.getElementById(tabName + '-form').classList.add('active');
        }

        // Enable/disable register buttons based on terms acceptance
        document.querySelectorAll('.accept-terms').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const form = this.closest('form');
                const submitBtn = form.querySelector('.register-btn');
                submitBtn.disabled = !this.checked;
            });
        });

        // Add floating animation to shapes
        document.addEventListener('DOMContentLoaded', function() {
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                shape.style.animationDelay = (index * 2) + 's';
            });
        });
    </script>
</body>
</html>