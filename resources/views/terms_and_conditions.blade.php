<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
        <title>Terms And Conditions</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            
            * {
              font-family: "Roboto", serif;
              font-weight: 400;
              font-style: normal;
            }

            body, html {
                height: 100%;
                margin: 0;
                /*font-family: Arial, sans-serif;*/
            }
    
            .background-image {
                background-image: url('https://img.freepik.com/premium-vector/dark-blue-banner-with-text-coming-soon-website-is-construction-maintenance-background_624052-883.jpg');
                background-size: cover;
                background-position: center;
                height: 100vh; /* Full viewport height */
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
            }
    
            .overlay {
                background-color: rgba(0, 0, 0, 0.5); /* Dark overlay for contrast */
                padding: 30px;
                border-radius: 10px;
                text-align: center;
            }
    
            .overlay h1 {
                font-size: 3rem;
            }
    
            .overlay p {
                font-size: 1.25rem;
            }
            .para p{
                text-align: justify;
                text-indent: 3em;
                color: rgba(0, 0, 0, 0.75);
                font-size: 0.9em;
            }
            .title{
                color: #344767;
                font-weight: bolder;
            }
            .img{
                width: 100%;
            }
            .sub-para::before {
                content: "o\00A0\00A0";
                color: #fb8c00 !important;
            }
            .accordion-button:focus{
                box-shadow: none !important;
            }
            #footer a:hover{
                color: #cdcdcd !important;
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
                    <ul style="font-size: 13px;" class="navbar-nav ms-auto">
                        
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
        
        <!--Terms of use-->
        <div class="container mt-5" id="term-of-use">
            <div class="row">
                <div class="col-12 para">
                    
                    <h3 class="title">Terms of use</h3>
                    <p>
                        Welcome to MM Certify! By using our certificate and document verification services and platform, you agree to comply with and be bound by the following terms and conditions. Please read them carefully before using our services.
                    </p>
                    
                    <h3 class="title">Acceptance of Terms</h3>
                    <p>
                        By accessing or using MM Certify's services, you agree to these Terms and Conditions, along with our Privacy Policy. If you do not agree, please do not use our services.
                    </p>
                    
                    <h3 class="title">Description of Services</h3>
                    <p>
                        MM Certify provides verification services to confirm the authenticity and integrity of educational and professional credentials. Our services are available to individuals, institutions, employers, and other organizations requiring credential validation.
                    </p>
                    
                    <h3 class="title">User Accounts</h3>
                    <p>
                        To access some features of our services, you may be required to create an account. You agree to provide accurate, current, and complete information and to maintain the security of your account credentials. You are responsible for all activities that occur under your account.
                    </p>
                    
                    <h3 class="title">Use of Services</h3>
                    <p>
                       You agree to use our services solely for lawful purposes. You may not use the platform:
                    </p>
                    <p class="sub-para">
                        To falsify information or misrepresent credentials.
                    </p>
                    <p class="sub-para">
                        For any unauthorized or illegal purposes.
                    </p>
                    <p class="sub-para">
                        To attempt to bypass security measures or interfere with the platform's operation.
                    </p>
                    
                    <h3 class="title">Data Privacy and Security</h3>
                    <p>
                        MM Certify respects your privacy and is committed to protecting your data. We handle all personal and credential information in accordance with our Privacy Policy. By using our services, you consent to our collection, use, and storage of information as described in the Privacy Policy.
                    </p>
                    
                    <h3 class="title">Accuracy of Information</h3>
                    <p>
                        MM Certify makes every effort to ensure the accuracy of the verification data. However, we do not guarantee that all information will be completely error-free, nor are we responsible for any inaccuracy or incompleteness of information provided by third parties.
                    </p>
                    
                    <h3 class="title">Fees and Payment</h3>
                    <p>
                        Use of some services on the platform may require a fee. By opting for paid services, you agree to pay the applicable fees. Payments are non-refundable unless stated otherwise in our refund policy. We reserve the right to change our pricing and fees with reasonable notice.
                    </p>
                    
                    <h3 class="title">Limitation of Liability</h3>
                    <p>
                        MM Certify shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use or inability to use our services. Our maximum liability in connection with our services, regardless of the cause, will not exceed the fees paid for the service in question.
                    </p>
                    
                    <h3 class="title">Third-Party Links</h3>
                    <p>
                       Our platform may contain links to third-party websites. These links are provided for convenience and do not imply endorsement or responsibility for the content on those sites. Use of third-party websites is subject to their own terms and privacy policies.
                    </p>
                    
                    <h3 class="title">Termination of Services</h3>
                    <p>
                       MM Certify reserves the right to suspend or terminate your access to our services at any time if we believe you have violated these Terms and Conditions or engaged in unlawful or harmful conduct.
                    </p>
                    
                    <h3 class="title">Changes to Terms</h3>
                    <p>
                       MM Certify reserves the right to modify these Terms and Conditions at any time. We will provide notice of significant changes by updating the date at the top of this document and, where appropriate, notifying users via email or on our platform. Continued use of our services after changes constitute your acceptance of the revised terms.
                    </p>
                    
                    <h3 class="title">Contact Us</h3>
                    <p>
                       If you have any questions or concerns about these Terms and Conditions, please contact us at [Contact Email Address].
                    </p>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--Privacy-->
        <div class="container mt-5" id="privacy">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Privacy</h3>
                    <p>
                        At MM Verify, we are committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and safeguard your information when you use our certificate verification services and platform. By using our services, you consent to the practices described in this policy.
                    </p>
                    
                    <h3 class="title">1. Information We Collect</h3>
                    <p>
                        We collect various types of information to provide and improve our services. This includes:
                    </p>
                    <p class="sub-para">
                        Personal Information: When you create an account or use our verification services, we may collect personal information such as your name, email address, phone number, and payment information.
                    </p>
                    <p class="sub-para">
                        Credential Information: For verification purposes, we may collect details of your educational and professional credentials, including institution names, degree or certificate titles, and dates.
                    </p>
                    <p class="sub-para">
                        Usage Data: We collect information about how you interact with our platform, such as your IP address, browser type, device information, and browsing history.
                    </p>
                    <p class="sub-para">
                        Cookies: We use cookies and similar tracking technologies to enhance your experience on our platform. For more details, please refer to our [Cookie Policy].
                    </p>
                    
                    <h3 class="title">2. How We Use Your Information</h3>
                    <p>
                        We use the information we collect for various purposes, including:
                    </p>
                    <p class="sub-para">
                        Verification Services: To authenticate and verify the accuracy of educational and professional credentials.
                    </p>
                    <p class="sub-para">
                        Improving Our Services: To analyze usage patterns, identify improvements, and optimize our platform’s performance.
                    </p>
                    <p class="sub-para">
                        Customer Support: To respond to your inquiries and provide assistance.
                    </p>
                    <p class="sub-para">
                        Marketing and Communications: To send you updates, promotional materials, or other relevant information if you have opted into such communications.
                    </p>
                    <p class="sub-para">
                        Security and Fraud Prevention: To protect our platform, users, and data against unauthorized access, cyber threats, or fraudulent activities.
                    </p>
                    
                    <h3 class="title">3. Sharing Your Information</h3>
                    <p>
                        MM Certify will not share, sell, or rent your personal information to third parties without your consent, except in the following cases:
                    </p>
                    <p class="sub-para">
                        Service Providers: We may share your information with third-party vendors who assist in our operations, such as payment processors, data analytics providers, or customer support services.
                    </p>
                    <p class="sub-para">
                        Legal Compliance: We may disclose your information to comply with legal obligations, such as responding to subpoenas or lawful requests from authorities.
                    </p>
                    <p class="sub-para">
                        Business Transfers: In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.
                    </p>
                    
                    <h3 class="title">4. Data Security</h3>
                    <p>
                        We implement industry-standard security measures to protect your information from unauthorized access, disclosure, alteration, or destruction. These measures include encryption, secure servers, and access controls. However, no data transmission over the internet or storage system is 100% secure, so we cannot guarantee absolute security.
                    </p>
                    
                    <h3 class="title">5. Data Retention</h3>
                    <p>
                        We retain your information for as long as necessary to fulfill the purposes for which it was collected, including to comply with legal, regulatory, or reporting obligations. When we no longer need your information, we will securely delete or anonymize it.
                    </p>
                    
                    <h3 class="title">6. Changes to This Privacy Policy</h3>
                    <p>
                        We may update this Privacy Policy from time to time. When we do, we will update the effective date at the top of this policy and, where appropriate, notify you by email or through our platform. Your continued use of our services after any changes signifies your acceptance of the revised policy.
                    </p>
                    
                    <h3 class="title">7. Contact Us</h3>
                    <p>
                        If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
                    </p>
                    <p>
                        [ ImpactSpire Co.,Ltd ]
                    </p>
                    <p>
                        [Address]
                    </p>
                    <p>
                        [Contact Email Address]
                    </p>
                    <p>
                        [Contact Phone Number]
                    </p>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--Disclaimer-->
        <div class="container mt-5" id="disclaimers">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Disclaimer</h3>
                    
                    <p>
                        MM Verify’s services are intended to provide general information regarding the verification of educational and professional credentials. Our platform verifies credentials based on data provided by third-party institutions and organizations. We do not create or alter the content of the credentials we verify.
                    </p>
                    
                    <p>
                        MM Verify provides verification services based on available information but does not endorse, represent, or validate the institutions, individuals, or credentials submitted for verification. The inclusion of any institution or credential in our database does not imply approval or endorsement by MM Verify.
                    </p>
                    
                    <p>
                        MM Verify is not liable for any direct, indirect, incidental, or consequential damages arising from the use of our platform or reliance on the verification services provided. This includes but is not limited to loss of income, employment opportunities, or reputational harm. Users accept all risks associated with the use of our services.
                    </p>
                    
                    <p>
                        MM Verify strives to provide continuous and uninterrupted service; however, we do not guarantee that our platform will always be available or that access will be uninterrupted. MM Verify may temporarily suspend or discontinue services for maintenance, upgrades, or other reasons, without prior notice.
                    </p>
                    
                    <p>
                        MM Verify reserves the right to modify or update this disclaimer at any time. Any changes will be effective immediately upon posting on our platform. Your continued use of our services following any modifications constitutes your acceptance of the revised disclaimer.
                    </p>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--GDPR-->
        <div class="container mt-5" id="gdpr">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">How MM Certify stays GDPR-compliant</h3>
                    
                    <p>
                        GDPR compliant means that an organization, system, or process adheres to the General Data Protection Regulation (GDPR), a privacy and security law enacted by the European Union (EU). Being GDPR compliant involves meeting the requirements to protect the personal data and privacy of EU citizens, even if the business is located outside the EU.
                    </p>
                    
                    <p>
                        We are working hard to become a fully GDPR-compliant certificate and document verification platform. At MM Certify, protecting your privacy is our top priority, and we’ve succeeded in making sure our company and services are GDPR-friendly from start to finish.
                    </p>
                    
                    <p>
                        Key elements of GDPR compliance include:
                    </p>
                    
                    <p class="sub-para">
                        1.	Lawful Basis for Data Processing: Organizations must have a valid legal reason to collect and process personal data, such as consent, contractual necessity, or legitimate interest.
                    </p>
                    
                    <p class="sub-para">
                        2.	Transparency: Businesses must clearly inform individuals about what data is being collected, why, and how it will be used.
                    </p>
                    
                    <p class="sub-para">
                        3.	Data Minimization: Only collect the data necessary for the specified purpose.
                    </p>
                    
                    <p class="sub-para">
                        4.	Rights of Individuals: Respect rights such as the right to access, correct, delete (right to be forgotten), and transfer their data.
                    </p>
                    
                    <p class="sub-para">
                        5.	Consent: If relying on consent, it must be freely given, specific, informed, and unambiguous, with the ability for users to withdraw it easily.
                    </p>
                    
                    <p class="sub-para">
                        6.	Security: Implement appropriate technical and organizational measures to protect data from breaches.
                    </p>
                    
                    <p class="sub-para">
                        7.	Data Breach Notifications: Notify relevant authorities and potentially affected individuals within 72 hours of a data breach.
                    </p>
                    
                    <p class="sub-para">
                        8.	Cross-Border Data Transfers: Ensure data transferred outside the EU meets GDPR safeguards, such as through standard contractual clauses or binding corporate rules.
                    </p>
                    
                    <p class="sub-para">
                        9.	Accountability and Documentation: Maintain records of data processing activities, perform data protection impact assessments (DPIAs) when necessary, and appoint a Data Protection Officer (DPO) if required.
                    </p>
                    
                </div>
            </div>
            
            <hr>
        </div>

        
        <div class="container-fluid text-center mt-5 py-4" style="background: #344767; color: #fff;" id="footer">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="mb-3">MM Certify is a company by ImpactSpire Co.,Ltd</h4>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/terms-and-conditions#privacy') }}" class="mb-2" style="text-decoration: none; color: #fff;" >Privacy</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/terms-and-conditions#term-of-use') }}" class="mb-2" style="text-decoration: none; color: #fff;" >Term Of Use</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/terms-and-conditions#disclaimers') }}" class="mb-2" style="text-decoration: none; color: #fff;" >Disclaimer</a>
                </div>
                <div class="col-md-2 mb-2">
                    <a href="{{ url('/#contact-us') }}" class="" style="text-decoration: none; color: #fff;" >Contact Us</a>
                </div>
                <div class="col-md-4">
                    <div class="text-center mb-2">
                        <a href="{{ url('/terms-and-conditions#gdpr') }}">
                            <img src="{{ asset('/images/GDPR.png') }}" class="" style="height: 4rem; border-radius: 10px;" alt="" />    
                        </a>
                        <p class="m-0" style="font-size: 0.8em;">Your data is save with us</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <span style="font-size: 0.8em" >Mobile Phone : 09799263405</span>
                </div>
                <div class="col-md-2">
                    <span style="font-size: 0.8em">Viber        : 09799263405</span>
                </div>
                <div class="col-md-2">
                    <span style="font-size: 0.8em">Telegram     : 09799263405</span>
                </div>
                <div class="col-md-2">
                    <span style="font-size: 0.8em">Email        : info@mmcertify.com</span>
                </div>
                <div class="col-12">
                    <br>
                    <a href="https://www.facebook.com/mmcertify" target="_blank" class="btn btn-primary me-2" style="border-radius: 50%;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/mmcertify" target="_blank" class="btn btn-info" style="border-radius: 50%; color: white;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        
    </body>
    
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>

</html>
