<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <!-- Add Font Awesome for the admin icon -->
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
         <style>
            #regtitle{
                border: 1px solid rgba(0,0,0,0.175);
                border-bottom: none;
                margin: 0;
            }
            #regtitle div{
                padding: 0.7rem 0.5rem;
                text-align: center;
                font-size: 0.9em;
                cursor: pointer;
                user-select: none;
            }
            #regtitle div:hover{
                background-color: rgb(83 148 244);
                color: #fff;
            }
            .active{
                background-color: rgba(13,110,253,255) !important;
                color: #fff;
            }
            #regform, #regform2{
                border-radius: 0;
            }
         </style>
    </head>
    <body>
        <!-- Navbar bg-primary -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ asset('mmlogo.jpg') }}" style="height: 100px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link text-primary ms-4" href="#">About Us</a>-->
                        <!--</li>-->
                        
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle text-primary" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ url('/#about-us') }}">About Us</a></li>
                                <li><a class="dropdown-item" href="{{ url('/#vision-mission') }}">Vision & Mission</a></li>
                                <li><a class="dropdown-item" href="{{ url('/#core-values') }}">Core Values</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-primary ms-4" href="{{ url('/#product-service') }}">Product & Service</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-primary ms-4" href="{{ url('/#users-benefits') }}">Users' Benefits</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-primary ms-4" href="{{ url('/#faqs') }}">FAQs</a>
                        </li>
                            
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-primary ms-4" href="{{ route('register') }}">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary ms-4" href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            
                            @hasrole('admin')
                                <li class="nav-item">
                                    <a class="nav-link text-primary ms-4" href="{{ url('/admin') }}">
                                        <i class="fas fa-cogs"></i> Admin
                                    </a>
                                </li>
                            @elsehasrole('user')
                                <li class="nav-item">
                                    <a class="nav-link text-primary ms-4" href="{{ url('/user') }}">
                                        <i class="fas fa-cogs"></i> Admin
                                    </a>
                                </li>
                            @endhasrole
                            <li class="nav-item">
                                <a class="nav-link text-primary ms-4" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                        
                        <li class="nav-item">
                            <a class="nav-link text-primary ms-4" href="{{ url('/check') }}">
                                <i class="fas fa-search"></i> Check
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    
                    <h6 class="text-center mb-3">Please provide the required information below to create an academic or business institution account for issuing verifiable digital certificates on the MM Certify platform.</h6>
                    
                    <h2 class="text-center mb-4">Account Registration</h2>
                        <div class="row" id="regtitle">
                            <div class="col-12 active">
                                <!--College / University-->
                                Academic or Business Institution
                            </div>
                            <div class="col-6 d-none">
                                Visitor / Employer
                            </div>
                        </div>
                        
                        <div class="card p-3 regform d-none" id="regform">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>

                                <!-- Terms of Use and Privacy Policy -->
                                <div class="mb-3">
                                    <label class="form-label d-block">Please read and accept our Terms of Use and Privacy Policy to continue</label>
                                    <div class="border p-2" style="height:180px; overflow-y:auto; font-size:0.85rem; background:#f8f9fa;">
                                        <strong>TERMS OF USE</strong><br>
                                        Welcome to MM Certify! By using our certificate and document verification services and platform, you agree to comply with and be bound by the following terms and conditions. Please read them carefully before using our services.<br><br>
                                        By registering on MMCertify.com, you agree to the following:<br>
                                        1. Eligibility: You must be an authorized representative of a recognized academic or business institution.<br>
                                        2. Account Responsibility: You are responsible for maintaining the confidentiality of your account credentials and for all activities conducted under your account.<br>
                                        3. Certificate Authenticity: You confirm that all certificates issued through the platform are genuine and accurate.<br><br>
                                        <strong>Description of Services</strong><br>
                                        MM Certify provides verification services to confirm the authenticity and integrity of educational and professional credentials. Our services are available to individuals, institutions, employers, and other organizations requiring credential validation.<br><br>
                                        <strong>User Accounts</strong><br>
                                        To access some features of our services, you may be required to create an account. You agree to provide accurate, current, and complete information and to maintain the security of your account credentials. You are responsible for all activities that occur under your account.<br><br>
                                        <strong>Use of Services</strong><br>
                                        <strong>Accuracy of Information</strong><br>
                                        MM Certify makes every effort to ensure the accuracy of the verification data. However, we do not guarantee that all information will be completely error-free, nor are we responsible for any inaccuracy or incompleteness of information provided by third parties.
                                        <br><br>
                                        <strong>Fees and Payment</strong><br>
                                        Use of some services on the platform may require a fee. By opting for paid services, you agree to pay the applicable fees. Payments are non-refundable unless stated otherwise in our refund policy. We reserve the right to change our pricing and fees with reasonable notice.
                                        <br><br>
                                        <strong>Limitation of Liability</strong><br>
                                        MM Certify shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use or inability to use our services. Our maximum liability in connection with our services, regardless of the cause, will not exceed the fees paid for the service in question.
                                        <br><br>
                                        <strong>Termination of Services</strong><br>
                                        MM Certify reserves the right to suspend or terminate your access to our services at any time if we believe you have violated these Terms and Conditions or engaged in unlawful or harmful conduct.
                                        <br><br>
                                        <strong>Changes to Terms</strong><br>
                                        MM Certify reserves the right to modify these Terms and Conditions at any time. We will provide notice of significant changes by updating the date at the top of this document and, where appropriate, notifying users via email or on our platform. Continued use of our services after changes constitute your acceptance of the revised terms.
                                        <br><br>
                                        <strong>🔐 PRIVACY POLICY</strong><br>
                                        <strong>Privacy</strong><br>
                                        At MM Verify, we are committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and safeguard your information when you use our certificate verification services and platform. By using our services, you consent to the practices described in this policy.
                                        <br><br>
                                        <strong>1. Information We Collect</strong><br>
                                        MM Certify will implement appropriate technical and organizational measures to ensure the security and integrity of the data processed on its platform. However, MM Certify does not collect or request sensitive personal information from certificate holders, such as phone numbers, bank account details, addresses, national ID numbers, or passport numbers.
We collect various types of information to provide and improve our services. This includes:
•	Personal Information: When you create an account or use our verification services, we may collect personal information such as your name, business email and address, business phone number.
•	The academic and business institution is responsible for ensuring that any required consent has been obtained from certificate recipients, where applicable, for the use of their basic non-sensitive data (e.g., name, course details, issuance date) on the MM Certify platform for the purpose of certificate issuance and verification.

                                        <br><br>
                                        <strong>2. How We Use Your Information</strong><br>

                                        We use the information we collect for various purposes, including:
•	Verification Services: To authenticate and verify the accuracy of educational and professional credentials.
•	Improving Our Services: To analyze usage patterns, identify improvements, and optimize our platform’s performance.
•	Customer Support: To respond to your inquiries and provide assistance.
•	Marketing and Communications: To send you updates, promotional materials, or other relevant information if you have opted into such communications.
•	Security and Fraud Prevention: To protect our platform, users, and data against unauthorized access, cyber threats, or fraudulent activities.

      <br><br>
                                        <strong>3. Sharing Your Information</strong><br>
                                        MM Certify will not share, sell, or rent your personal information to third parties without your consent, except in the following cases:
•	Service Providers: We may share your information with third-party vendors who assist in our operations, such as payment processors, data analytics providers, or customer support services.
•	Legal Compliance: We may disclose your information to comply with legal obligations, such as responding to subpoenas or lawful requests from authorities.
•	Business Transfers: In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.

<br><br>
                                        <strong>4. Data Security</strong><br>
                                        We implement industry-standard security measures to protect your information from unauthorized access, disclosure, alteration, or destruction. These measures include encryption, secure servers, and access controls. However, no data transmission over the internet or storage system is 100% secure, so we cannot guarantee absolute security.
                                        <br><br>
                                        <strong>5. Data Retention</strong><br>
                                        We retain your information for as long as necessary to fulfill the purposes for which it was collected, including to comply with legal, regulatory, or reporting obligations. When we no longer need your information, we will securely delete or anonymize it.
                                        <br><br>
                                        <strong>6. Changes to This Privacy Policy</strong><br>
                                        We may update this Privacy Policy from time to time. When we do, we will update the effective date at the top of this policy and, where appropriate, notify you by email or through our platform. Your continued use of our services after any changes signifies your acceptance of the revised policy.
                                        <br><br>
                                        <strong>7. Contact Us</strong><br>
                                        If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
                                        <br>
                                        <strong>Grace Myanmar Global Enterprise Co.,Ltd </strong><br>
                                        Email :     info@mmcertify.com
                                        
                                        
                                        
                                        
                                        
                                        MM Certify is not liable for any damages or losses resulting from the use of our services. You agree to use our services solely for lawful purposes. You may not use the platform to falsify information, for any unauthorized or illegal purposes, or to attempt to bypass security measures or interfere with the platform's operation.<br><br>
                                        <strong>Data Privacy and Security</strong><br>
                                        MM Certify respects your privacy and is committed to protecting your data. We handle all personal and credential information in accordance with our Privacy Policy. By using our services, you consent to our collection, use, and storage of information as described in the Privacy Policy.<br><br>
                                        <em>(Full Terms of Use & Privacy Policy available at <a href="{{ url('/terms-and-conditions') }}" target="_blank">this link</a>.)</em>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input accept-terms" type="checkbox" value="1" id="acceptTerms1">
                                        <label class="form-check-label" for="acceptTerms1">
                                        By clicking, I accept the terms of use and privacy policy of this platform as may be applicable.
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 register-btn" disabled>Register</button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card p-3 regform mb-5" id="regform2">
                            <form method="POST" action="{{ route('register-uni') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name1" class="form-label">Academic or Business Institution Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name1" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="reg_number" class="form-label">Registration Number (if applicable)</label>
                                    <input type="text" class="form-control @error('reg_number') is-invalid @enderror" id="reg_number" name="reg_number" value="{{ old('reg_number') }}" >
                                    @error('reg_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="contact_name" class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
                                    @error('contact_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Person Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Academic or Business Institution Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required></textarea>
                                    
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email1" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email1" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password1" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation1" name="password_confirmation" required>
                                </div>

                                <!-- Terms of Use and Privacy Policy -->
                                <div class="mb-3">
                                    <label class="form-label d-block">Please read and accept our Terms of Use and Privacy Policy to continue</label>
                                    <div class="border p-2" style="height:180px; overflow-y:auto; font-size:0.85rem; background:#f8f9fa;">
                                        <strong>TERMS OF USE</strong><br>
                                        Welcome to MM Certify! By using our certificate and document verification services and platform, you agree to comply with and be bound by the following terms and conditions. Please read them carefully before using our services.<br><br>
                                        By registering on MMCertify.com, you agree to the following:<br>
                                        1. Eligibility: You must be an authorized representative of a recognized academic or business institution.<br>
                                        2. Account Responsibility: You are responsible for maintaining the confidentiality of your account credentials and for all activities conducted under your account.<br>
                                        3. Certificate Authenticity: You confirm that all certificates issued through the platform are genuine and accurate.<br><br>
                                        <strong>Description of Services</strong><br>
                                        MM Certify provides verification services to confirm the authenticity and integrity of educational and professional credentials. Our services are available to individuals, institutions, employers, and other organizations requiring credential validation.<br><br>
                                        <strong>User Accounts</strong><br>
                                        To access some features of our services, you may be required to create an account. You agree to provide accurate, current, and complete information and to maintain the security of your account credentials. You are responsible for all activities that occur under your account.<br><br>
                                        <strong>Use of Services</strong><br>
                                        You agree to use our services solely for lawful purposes. You may not use the platform to falsify information, for any unauthorized or illegal purposes, or to attempt to bypass security measures or interfere with the platform's operation.<br><br>
                                        
                                        <strong>Accuracy of Information</strong><br>
                                        MM Certify makes every effort to ensure the accuracy of the verification data. However, we do not guarantee that all information will be completely error-free, nor are we responsible for any inaccuracy or incompleteness of information provided by third parties.<br><br>
                                        
                                        <strong>Fees and Payment</strong><br>
                                        Use of some services on the platform may require a fee. By opting for paid services, you agree to pay the applicable fees. Payments are non-refundable unless stated otherwise in our refund policy. We reserve the right to change our pricing and fees with reasonable notice.<br><br>
                                        
                                        <strong>Limitation of Liability</strong><br>
                                        MM Certify shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use or inability to use our services. Our maximum liability in connection with our services, regardless of the cause, will not exceed the fees paid for the service in question.<br><br>
                                        
                                        <strong>Termination of Services</strong><br>
                                        MM Certify reserves the right to suspend or terminate your access to our services at any time if we believe you have violated these Terms and Conditions or engaged in unlawful or harmful conduct.<br><br>
                                        
                                        <strong>Changes to Terms</strong><br>
                                        MM Certify reserves the right to modify these Terms and Conditions at any time. We will provide notice of significant changes by updating the date at the top of this document and, where appropriate, notifying users via email or on our platform. Continued use of our services after changes constitute your acceptance of the revised terms.<br><br>
                                        
                                        <strong>🔐 PRIVACY POLICY</strong><br><br>
                                        
                                        <strong>Privacy</strong><br>
                                        At MM Verify, we are committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and safeguard your information when you use our certificate verification services and platform. By using our services, you consent to the practices described in this policy.<br><br>
                                        
                                        <strong>1. Information We Collect</strong><br>
                                        MM Certify will implement appropriate technical and organizational measures to ensure the security and integrity of the data processed on its platform. However, MM Certify does not collect or request sensitive personal information from certificate holders, such as phone numbers, bank account details, addresses, national ID numbers, or passport numbers.<br>
                                        We collect various types of information to provide and improve our services. This includes:<br>
                                        • Personal Information: When you create an account or use our verification services, we may collect personal information such as your name, business email and address, business phone number.<br>
                                        • The academic and business institution is responsible for ensuring that any required consent has been obtained from certificate recipients, where applicable, for the use of their basic non-sensitive data (e.g., name, course details, issuance date) on the MM Certify platform for the purpose of certificate issuance and verification.<br><br>
                                        
                                        <strong>2. How We Use Your Information</strong><br>
                                        We use the information we collect for various purposes, including:<br>
                                        • Verification Services: To authenticate and verify the accuracy of educational and professional credentials.<br>
                                        • Improving Our Services: To analyze usage patterns, identify improvements, and optimize our platform's performance.<br>
                                        • Customer Support: To respond to your inquiries and provide assistance.<br>
                                        • Marketing and Communications: To send you updates, promotional materials, or other relevant information if you have opted into such communications.<br>
                                        • Security and Fraud Prevention: To protect our platform, users, and data against unauthorized access, cyber threats, or fraudulent activities.<br><br>
                                        
                                        <strong>3. Sharing Your Information</strong><br>
                                        MM Certify will not share, sell, or rent your personal information to third parties without your consent, except in the following cases:<br>
                                        • Service Providers: We may share your information with third-party vendors who assist in our operations, such as payment processors, data analytics providers, or customer support services.<br>
                                        • Legal Compliance: We may disclose your information to comply with legal obligations, such as responding to subpoenas or lawful requests from authorities.<br>
                                        • Business Transfers: In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.<br><br>
                                        
                                        <strong>4. Data Security</strong><br>
                                        We implement industry-standard security measures to protect your information from unauthorized access, disclosure, alteration, or destruction. These measures include encryption, secure servers, and access controls. However, no data transmission over the internet or storage system is 100% secure, so we cannot guarantee absolute security.<br><br>
                                        
                                        <strong>5. Data Retention</strong><br>
                                        We retain your information for as long as necessary to fulfill the purposes for which it was collected, including to comply with legal, regulatory, or reporting obligations. When we no longer need your information, we will securely delete or anonymize it.<br><br>
                                        
                                        <strong>6. Changes to This Privacy Policy</strong><br>
                                        We may update this Privacy Policy from time to time. When we do, we will update the effective date at the top of this policy and, where appropriate, notify you by email or through our platform. Your continued use of our services after any changes signifies your acceptance of the revised policy.<br><br>
                                        
                                        <strong>7. Contact Us</strong><br>
                                        If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:<br>
                                        <b>Grace Myanmar Global Enterprise Co.,Ltd</b><br>
                                        MM Certify is owned and managed by Grace Myanmar Global Enterprise Co., Ltd., a company registered with the Directorate of Investment and Company Administration (DICA), Registration No. 143701395.<br>
                                        Email: info@mmcertify.com<br><br>
                                        
                                       
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input accept-terms" type="checkbox" value="1" id="acceptTerms2">
                                        <label class="form-check-label" for="acceptTerms2">
                                        By clicking, I accept the terms of use and privacy policy of this platform as may be applicable.
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 register-btn" disabled>Register</button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                        
                </div>
            </div>
        </div>
        
        <div id="carouselExampleControls" class="carousel slide d-none" data-bs-ride="carousel">
            <div class="carousel-inner ban">
                
                
                    <div class="carousel-item active">
                        <img src="https://goldious.net/upload/banners/675d2503dc9fb_Grilled%20Duck.png" class="d-block w-100" style="height: 33vw;" alt="Electric Banner Image">
                    </div>
            
                    <div class="carousel-item">
                        <img src="https://goldious.net/upload/banners/675d251b3347c_Mala%20Xioa%20Guo.png" class="d-block w-100" style="height: 33vw;" alt="Electric Banner Image">
                    </div>
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
    </body>

    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            
            // $("#regtitle div").click(function(){
            //     if($(this).hasClass('active')){
            //         return;
            //     }
            //     $("#regtitle div").removeClass('active');
            //     $(this).addClass('active');
            //     $(".regform").toggleClass('d-none');
            // });

            // Enable submit button when terms accepted
            $(document).on('change', '.accept-terms', function(){
                var form = $(this).closest('form');
                form.find('.register-btn').prop('disabled', !$(this).is(':checked'));
            });
                   
        });
    </script>
    
</html>
