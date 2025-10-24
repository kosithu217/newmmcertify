<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner with MMCertify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 80px 0;
            margin-bottom: 50px;
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .partner-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
        }
        .partner-card:hover {
            transform: translateY(-5px);
        }
        .partner-section {
            padding: 60px 0;
        }
        .highlight-box {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }
    </style>
</head>
<body>
    @include('nav')

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Become a Partner</h1>
            <p class="lead">We are open to <strong>Venture Capital firms</strong> and <strong>Strategic investors</strong> who share our vision to accelerate product development and drive rapid expansion across Myanmar, Thailand, and beyond.</p>
        </div>
    </section>

    <!-- Why Invest Section -->
    <section class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Invest in MMCertify.com</h2>
            <p class="lead">As education and credential verification shift toward digital transformation, MM Certify is leading the way—delivering a secure and scalable solution that ensures authenticity, combats fraud, and enhances institutional integrity.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card partner-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">🌍</div>
                        <h4>Market Demand</h4>
                        <p class="card-text">Growing global need for verifiable credentials in education and professional sectors.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card partner-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">💡</div>
                        <h4>Proven Platform</h4>
                        <p class="card-text">Functional prototype with real institutional users and automated QR verification system.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card partner-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">🚀</div>
                        <h4>Scalable Model</h4>
                        <p class="card-text">Designed to expand regionally across Southeast Asia with subscription and per-certificate business models.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card partner-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">🔒</div>
                        <h4>Secure & Compliant</h4>
                        <p class="card-text">Built on modern web technologies ensuring data security and authenticity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Section -->
    <section class="partner-section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">We Welcome Discussions With</h2>
                    <ul class="list-unstyled">
                        <li class="mb-2">• Venture Capital Firms</li>
                        <li class="mb-2">• Angel Investors</li>
                        <li class="mb-2">• Strategic Education Partners</li>
                        <li class="mb-2">• Impact Funds and Tech Accelerators</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="highlight-box">
                        <h4 class="mb-3">Get in Touch</h4>
                        <p>We welcome investors and strategic partners to connect with us to explore collaboration opportunities.</p>
                        <a href="mailto:info@mmcertify.com" class="btn btn-primary mt-3">
                            <i class="fas fa-envelope me-2"></i>info@mmcertify.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>