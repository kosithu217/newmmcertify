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
            /* Product & Service section */
            .ps-section{
                background:transparent;
                border-radius:0;
                box-shadow:none;
                border:none;
                padding:0;
            }
            .ps-section p{
                color: rgba(0, 0, 0, 0.75);
                line-height: 1.8;
                font-size: 0.95rem;
            }
            .ribbon-wrapper{ }
            .ribbon-badge{
                display:inline-block;
                background:linear-gradient(90deg,#2979ff,#3f51b5);
                color:#fff;
                font-weight:700;
                letter-spacing:.02em;
                padding:.5rem 1rem;
                border-radius:6px;
                text-transform:uppercase;
                font-size:20px;
                position:relative;
            }
            .ribbon-badge::before,
            .ribbon-badge::after{
                content:"";
                position:absolute;
                top:50%;
                transform:translateY(-50%);
                width:0; height:0;
                border-top:12px solid transparent;
                border-bottom:12px solid transparent;
            }
            .ribbon-badge::before{ left:-12px; border-right:12px solid #2c5bda; }
            .ribbon-badge::after{ right:-12px; border-left:12px solid #3750bf; }
            /* subtle callout text under products image */
            .ps-highlight-text{
                color:#3f51b5; /* indigo */
                font-weight:600;
                letter-spacing:.2px;
                display:inline-flex;
                align-items:center;
                gap:.4rem;
                text-align:center;
                white-space:normal;
            }
            .ps-highlight-text i{ color:#3f51b5; }
            /* limit side-by-side service images */
            .half-img{ max-width:100%; width:100%; height:auto; }
            /* fixed width images for certificate/transcript preview */
            .ps-fixed-img{ width:288px; max-width:100%; height:auto; }

            @media (max-width: 576px){
                .ps-section{ padding: 0 !important; }
                .ribbon-badge{ font-size:.72rem; padding:.4rem .75rem; }
                .ps-section p{ font-size:0.9rem; }
                .half-img{ max-width:100%; }
            }
            </style>
        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <!-- Include Navigation -->
        @include('nav')
       
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
                    <div class="text-center mb-3 ribbon-wrapper">
                        <span class="ribbon-badge">E- Certificate Issuing and Verification Platform</span>
                    </div>
                    <p>
                        MMCertify.com is a web-based platform that partners with local academic institutions to transform the way educational certificates are issued and verified. Through our platform, education centers, vocational schools, colleges, and both public and private schools can securely issue verifiable certificates, ensuring authenticity and trust in every credential. This empowers students, employers, and organizations to quickly and reliably authenticate qualifications in a secure, tamper-proof way.
                    </p>
                    <div class="text-center my-3">
                        <img src="{{ asset('/images/viber_image_2025-09-13_18-19-49-816.jpg') }}" class="img-fluid" alt="Products & Services Illustration" style="max-width: 900px; width: 100%; height: auto;">
                    </div>
                    

                    <div class="text-center mb-3 ribbon-wrapper">
                        <span class="ribbon-badge">Online Pre-Verification for Degree Certificates and Documents </span>
                    </div>
                    <p>
                    Our Online Pre-Verification service ensures that your academic and professional 
documents are authenticated before submission. This process helps reduce delays, 
build trust, and improve acceptance rates by confirming the credibility of your 
certificates in advance.
Job seekers often require pre-verified certificates to demonstrate their qualifications 
and character to potential employers. Students may need verified documents for 
admission to universities, colleges, or training institutions—both locally and 
internationally. 
By using our Pre-Verification services, you gain confidence that your documents will be 
readily accepted, while employers and institutions receive assurance of authenticity.
                    </p>

                    <div class="text-center">
                        <img src="{{ asset('/images/1Product.png') }}" class="img-fluid" alt="Products & Services Illustration" style="max-width: 900px; width: 100%; height: auto;">
                    </div>
                     <br>
                    <div class="text-center mb-3 ribbon-wrapper">
                        <span class="ribbon-badge">Degree Certificate and Transcript obtaining Service</span>
                    </div>
                    <p>
                    We provide services in obtaining degree certificates and transcripts from government 
universities in Yangon and Mandalay on behalf of students who are currently residing 
overseas. Our service helps students living abroad conveniently obtain their degree 
certificates and transcripts from government universities in Myanmar, without the need 
to travel back in person.  
                    </p>

                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 gap-md-4">
                        <img src="{{ asset('/images/image-1.jpg') }}" class="ps-fixed-img" alt="Service Image 1">
                        <img src="{{ asset('/images/image-2.jpg') }}" class="ps-fixed-img" alt="Service Image 2">
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
                        
                        @if(session('error'))
                          <div class="alert alert-danger text-center">
                            {{ session('error') }}
                          </div>
                        @endif
                        
                        @if($errors->any())
                          <div class="alert alert-danger">
                            <ul class="mb-0">
                              @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
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
                            <p class="mb-0"><ion-icon name="mail-outline"></ion-icon><a href="mailto:ksta.fred@mmcertify.com" class="text-decoration-none ms-2">support@mmcertify.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-md-start">
                            <h5 class="fw-bold mb-1" style="font-size: 18px;">Yan Naing Htun <span class="text-muted">(伍健櫳 Wǔ Jiàn Lón)</span></h5>
                            <p class="mb-2 small text-uppercase text-primary">Country Director (Thailand)</p>
                            <p class="mb-2"><ion-icon name="call-outline"></ion-icon><a href="tel:+66634738566" class="text-decoration-none ms-2">+66&nbsp;(0)&nbsp;6-3473-8566</a></p>
                            <p class="mb-0"><ion-icon name="mail-outline"></ion-icon><a href="mailto:countrydirector@mmcertify.com" class="text-decoration-none ms-2">countrydirector@mmcertify.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      @include('footer')
        
    </body>
    
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
</html>
                        