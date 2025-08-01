<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="icon" type="image/png" href="https://mmcertify.com/storage/certificates/logos/mmcertify.png">
        <title>Home Page</title>
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
            
                    /* Contact info custom styles */
            .contact-info-card{
                background:#f8f9fa;
                border:none;
                border-radius:0.75rem;
                padding:1.5rem;
                box-shadow:0 0.5rem 1rem rgba(0,0,0,.05);
            }
            .contact-info-card h5{
                color:#344767;
            }
            .contact-info-card i{
                color:#fb8c00;
            }
            /* Ionicons inside contact card */
            .contact-info-card ion-icon{
                color:#fb8c00;
                font-size:1.3rem;
                vertical-align:middle;
            }
            </style>
        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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



                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link text-primary ms-4" href="{{ route('blog.index') }}">Blog Post</a>-->
                        <!--</li>-->
                        
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
        <!--<div class="background-image">-->
        <!--    <div class="overlay">-->
        <!--        <h1>Coming Soon</h1>-->
        <!--        <p>Our website is under construction. Stay tuned for updates!</p>-->
        <!--        @if (session('error'))-->
        <!--            <div class="alert alert-danger">-->
        <!--                {{ session('error') }}-->
        <!--            </div>-->
        <!--        @endif-->
        <!--    </div>-->
        <!--</div>-->
        
        <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner ban">
                
                
                    <div class="carousel-item active">
                        <img src="{{ asset('/images/Banner01.gif') }}" class="d-block w-100" style="height: 33vw;" alt="Banner Image 01">
                    </div>
            
                    <div class="carousel-item">
                        <img src="{{ asset('/images/Banner02.gif') }}" class="d-block w-100" style="height: 33vw;" alt="Banner Image 02">
                    </div>
                    
                    <div class="carousel-item">
                        <img src="{{ asset('/images/Banner03.gif') }}" class="d-block w-100" style="height: 33vw;" alt="Banner Image 03">
                    </div>
                
            </div>
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <!--<span class="sr-only">Previous</span>-->
            </a>
            <a class="carousel-control-next" href="#carouselControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <!--<span class="sr-only">Next</span>-->
            </a>
        </div>
        
        <!--About Us-->
        <div class="container mt-5" id="about-us">
            <div class="row">
                <div class="col-12 para">
                    
                    @session('error')
                        <p class="text-center text-white py-3 mb-3 bg-danger">{{ session('error') }}</p>
                    @endsession
                    
                    <h3 class="title">About Us</h3>
                    <p>
                        Welcome to MM Certify, your trusted partner for e-certificate issuing and verification. Our mission is to empower individuals, educational institutions, training providers and employers by ensuring that every certificate they issue or receive is authentic, verifiable, and easily accessible.
                    </p>
                    <p>
                        At MM Certify, our dedicated team upholds the highest standards of data accuracy, confidentiality, and integrity. We are proud to serve academic institutions, hospitals, recruitment agencies, employers, professional bodies in Myanmar and internationally, ensuring that qualifications and documents are trusted across sectors. Our commitment is to deliver a smooth and transparent verification process for individuals and organizations alike, paving the way for a future where credentials are universally trusted.
                    </p>
                    <div class="text-center ">
                        <img src="{{ asset('/images/AboutUs.gif') }}" class="img p-lg-5 p-md-5" alt="" />    
                    </div>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--Visiion & Mission-->
        <div class="container mt-5" id="vision-mission">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Vision</h3>
                    <p>
                        To be the most trusted authority in credential verification, supporting individuals, academic institutions, and businesses with secure and reliable solutions.
                    </p>
                    
                    <h3 class="title">Mission</h3>
                    <p>
                        "Our mission is to empower academic institutions, businesses, and individuals with secure and efficient verification solutions, fostering transparency and trust. Through advanced technology and unwavering commitment to authenticity, we aim to prevent fraud, uphold the value of credentials, and build confidence in every certified achievement."
                    </p>
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--Core Values-->
        <div class="container mt-5" id="core-values">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Core Values</h3>
                    
                    <h5 class="title" style="text-indent: 1em;">Trust</h5>
                    <p class="sub-para">
                        We prioritize building trust between individuals, organizations, and institutions by delivering accurate and reliable verification services.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Integrity</h5>
                    <p class="sub-para">
                        We uphold the highest ethical standards in handling sensitive information with confidentiality and respect.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Innovation</h5>
                    <p class="sub-para">
                        We embrace cutting-edge technology to continuously enhance our verification solutions and provide seamless user experiences.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Accuracy</h5>
                    <p class="sub-para">
                        We are committed to delivering precise and error-free results, ensuring the authenticity of every credential we verify.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Transparency</h5>
                    <p class="sub-para">
                        We operate with complete openness, enabling all stakeholders to understand and trust our processes.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Security</h5>
                    <p class="sub-para">
                        Protecting user data is our top priority. Our services are designed with robust encryption and compliance with global data privacy standards.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Efficiency</h5>
                    <p class="sub-para">
                        We streamline verification processes, saving time and resources for our clients without compromising quality.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Customer-Centricity</h5>
                    <p class="sub-para">
                        We are dedicated to understanding and fulfilling the unique needs of our clients and partners.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Accountability</h5>
                    <p class="sub-para">
                        We take full responsibility for the accuracy, security, and ethical delivery of our services.
                    </p>
                    
                    <h5 class="title" style="text-indent: 1em;">Empowerment</h5>
                    <p class="sub-para">
                        We empower institutions and individuals to make informed decisions based on verified credentials.
                    </p>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--Product & Service-->
        <div class="container mt-5" id="product-service">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Product & Service</h3>
                    
                    <h5 class="title text-center">Verifiable Digital Certificate Issuing and Verification Platform</h5>
                    <p>
                        We proudly collaborate with local academic institutions to revolutionize the way educational certificates are issued and verified. Through the MM Certify platform, education centers, vocational schools, colleges, private and public schools can securely issue verifiable certificates, ensuring authenticity and trust in every certification. This ensures that students, employers, and organizations can easily authenticate qualifications in a fast, reliable, and tamper-proof manner.
                    </p>
                    <!--<p>-->
                    <!--    As a result, they are highly trusted sources of information, enabling businesses or individuals to easily verify people's identities and qualifications online.-->
                    <!--</p>-->
                    
                    <h5 class="title text-center">Educational Certificate Attestation Services</h5>
                    <p>
                        Educational Certificate attestation services are available for individuals and businesses in both domestic and international locations, including those who offer study abroad education services and university admissions offices. Our process involves collaborating with local private and public academic institutions to verify certificates, diplomas, degrees, and transcripts.
Whether you're a job seeker looking to verify your certificates or a company ensuring the authenticity of an applicant's qualifications, we are here to help.
                    </p>
                    <p>
                        We can verify a wide range of certificates including: 
                    </p>
                    <!--<p>-->
                    <!--    We can verify a wide range of certificates including:-->
                    <!--</p>-->
                    <p class="sub-para">
                        Educational diplomas and degrees
                    </p>
                    <p class="sub-para">
                        Academic Transcripts
                    </p>
                    <p class="sub-para">
                        Professional certifications
                    </p>
                    <p class="sub-para">
                        Awards and achievements
                    </p>
                    <p class="sub-para">
                        Employment verification documents
                    </p>
                    <p class="sub-para">
                        Medical documents
                    </p>
                    
                    <div class="text-center">
                        <img src="{{ asset('/images/ProductAndService.gif') }}" class="img p-lg-5 p-md-5" alt="" />    
                    </div>
                    
                </div>
            </div>
            
            <hr>
        </div>
        
        <!--User Benefits-->
        <div class="container mt-5" id="users-benefits">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Users' Benefits</h3>
                    
                    <div class="text-center">
                        <img src="{{ asset('/images/user-benefits.png') }}" class="img" alt="" />    
                    </div>
                </div>
            </div>
            
            <hr>
        </div>

        <!-- Blog Posts -->        
        <div class="container mt-5" id="blog-posts">
            <div class="row">
                <div class="col-12">
                    <h3 class="title mb-4">Latest Blog Posts</h3>
                    <div class="row">
                        @forelse($blogs as $blog)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if($blog->images && count($blog->images) > 0)
                                        <img src="{{ asset('storage/certificates/images/' . $blog->images->first()->image_path) }}" 
                                            class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $blog->title }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                                            <a href="{{ route('blog.show', ['id' => $blog->id]) }}" class="btn btn-primary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">No blog posts available yet.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">View All Blog Posts</a>
                    </div>
                </div>
            </div>
            <hr class="mt-5">
        </div>
        
        <!--FAQs-->
        <div class="container mt-5" id="faqs">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">FAQs</h3>
                    
                    <!--Accor 1-->
                    <h5 class="title text-center mb-4">Issuers</h5>
                    <div class="accordion" id="faqAccordion">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                1. What is a verifiable certificate platform?
                              </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                              <div class="accordion-body para">
                                <p>
                                    A verifiable certificate platform is an online system that allows institutions to issue digital certificates that can be authenticated by third parties. The certificates typically use secure technologies to prevent fraud and ensure authenticity.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading2">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                2. Who can use this platform?
                              </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                              <div class="accordion-body para">
                                <p>
                                    The platform is designed for use by educational institutions, colleges, universities, training centers, vocational schools, certification bodies, and professional organizations to issue certificates efficiently and securely.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading3">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="true" aria-controls="faq3">
                                3. Why is verification important for certificates?
                              </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                              <div class="accordion-body para">
                                <p>
                                    Verification ensures the authenticity of certificates, prevents fraud, and builds trust among stakeholders, including employers, students, and institutions.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <!--Accor 2-->
                    <h5 class="title text-center my-4">Study Abroad Education Service Agencies and University Admission</h5>
                    <div class="accordion" id="faqAccordion2">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading21">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq21" aria-expanded="true" aria-controls="faq21">
                                1. How does the verification process work?
                              </button>
                            </h2>
                            <div id="faq21" class="accordion-collapse collapse" aria-labelledby="faqHeading21" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    Once we receive the necessary documents, we reach out to the issuing authority or institution to confirm the authenticity. Our team ensures secure handling of all documents, and the verification process typically takes from 3 to 7 business days.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading22">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq22" aria-expanded="true" aria-controls="faq22">
                                2. How much does the verification service cost?
                              </button>
                            </h2>
                            <div id="faq22" class="accordion-collapse collapse" aria-labelledby="faqHeading22" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    Our fees depend on the type and number of documents being verified. You can refer to our pricing page or contact us for a customized quote.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading23">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq23" aria-expanded="true" aria-controls="faq23">
                                 3. Are your services secure and confidential?
                              </button>
                            </h2>
                            <div id="faq23" class="accordion-collapse collapse" aria-labelledby="faqHeading23" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    Yes, confidentiality and data security are our top priorities. All documents and personal information provided to us are stored securely and used strictly for the purpose of verification.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading24">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq24" aria-expanded="true" aria-controls="faq24">
                                 4. How can I submit my documents for verification?
                              </button>
                            </h2>
                            <div id="faq24" class="accordion-collapse collapse" aria-labelledby="faqHeading24" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    You can upload your documents directly through our secure online portal, or send them via email or postal mail. Detailed instructions are provided in the submission section of our website.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading25">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq25" aria-expanded="true" aria-controls="faq25">
                                 5. What happens if my document cannot be verified?
                              </button>
                            </h2>
                            <div id="faq25" class="accordion-collapse collapse" aria-labelledby="faqHeading25" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    In cases where verification is not possible, we will provide a detailed explanation. This could be due to the issuing authority being unresponsive or the document not being recognized.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading26">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq26" aria-expanded="true" aria-controls="faq26">
                                 6. How do you handle discrepancies or fraudulent documents?
                              </button>
                            </h2>
                            <div id="faq26" class="accordion-collapse collapse" aria-labelledby="faqHeading26" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    If we identify a discrepancy or suspect a document is fraudulent, we will immediately notify the submitting party and the relevant stakeholders. We have strict protocols in place for handling such situations.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading27">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq27" aria-expanded="true" aria-controls="faq27">
                                 7. Do you offer bulk verification for businesses and institutions?
                              </button>
                            </h2>
                            <div id="faq27" class="accordion-collapse collapse" aria-labelledby="faqHeading27" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    Yes, we provide bulk verification services for businesses, educational institutions, and government bodies. Contact us to discuss your specific needs and get a tailored package.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading28">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq28" aria-expanded="true" aria-controls="faq28">
                                 8. Can I request expedited verification?
                              </button>
                            </h2>
                            <div id="faq28" class="accordion-collapse collapse" aria-labelledby="faqHeading28" data-bs-parent="#faqAccordion2">
                              <div class="accordion-body para">
                                <p>
                                    Yes, we offer expedited verification services for urgent requests. Please note that additional fees may apply, and the availability of this service depends on the responsiveness of the issuing authority.
                                </p>
                              </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>
            
            <hr class="mt-5">
        </div>
        
     

        <!--Contact Us-->
        <div class="container mt-5" id="contact-us">
            <div class="row">
                <div class="col-12 para">
                    <h3 class="title">Contact Us</h3>
                    
                    <div class="card mt-4">
                      
                      <div class="card-body">
                        @if(session('success'))
                          <div class="alert alert-success text-center">
                            {{ session('success') }}
                          </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                          </div>
                          <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" id="message" rows="4" placeholder="Write your message here" required></textarea>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="background-color: #344767; font-size: 0.9em;">Send Message</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <!-- Contact Information Section -->
        <div class="container my-5">
            <h2 class="text-center mb-4 title">Contact Information</h2>
            <div class="text-center small my-3">
            MMCertify.com is owned and managed by <strong>Grace Myanmar Global Enterprise Co., Ltd.</strong>, a company registered with the Directorate of Investment and Company Administration (DICA), Registration&nbsp;No.&nbsp;143701395.
        </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="card contact-info-card h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-1">Kyaw Si Thu Aung<span class="text-muted">@Fred</span></h5>
                            <p class="mb-2 small text-uppercase text-primary">Product Solution Director</p>
                            <p class="mb-2"><ion-icon name="call-outline"></ion-icon><a href="tel:+959799263405" class="text-decoration-none ms-2">+95&nbsp;(9)&nbsp;799263405</a></p>
                            <p class="mb-0"><ion-icon name="mail-outline"></ion-icon><a href="mailto:ksta.fred@mmcertify.com" class="text-decoration-none ms-2">ksta.fred@mmcertify.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-md-end">
                            <h5 class="fw-bold mb-1">Yan Naing Htun <span class="text-muted">(伍健權&nbsp;Wǔ&nbsp;Jiàn&nbsp;Lón)</span></h5>
                            <p class="mb-2 small text-uppercase text-primary">Country Director (Thailand)</p>
                            <p class="mb-2"><ion-icon name="call-outline"></ion-icon><a href="tel:+66634738566" class="text-decoration-none ms-2">+66&nbsp;(0)&nbsp;6-3473-8566</a></p>
                            <p class="mb-0"><ion-icon name="mail-outline"></ion-icon><a href="mailto:countrydirector@mmcertify.com" class="text-decoration-none ms-2">countrydirector@mmcertify.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid text-center mt-5 py-4" style="background: #344767; color: #fff;" id="footer">
            <div class="row align-items-center">
                <div class="col-12">
                    <!--<h4 class="mb-3">MM Certify is a company by ImpactSpire Co.,Ltd</h4>-->
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
                 <div class="col-md-2 mb-2">
                    <a href="{{ url('/blog') }}" class="" style="text-decoration: none; color: #fff;" >Blog Post</a>
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
        
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Search Certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="searchForm" method="POST" action="{{ url('/search') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Number</label>
                                <input type="number" class="form-control" id="number" name="number" min="0" max="999999" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
    
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
</html>
