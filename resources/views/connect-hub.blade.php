<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('nav')

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <div class="hero-content">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-university"></i>
                    </div>
                    <h1 class="hero-title mb-3">Public Profile Listing</h1>
                    <p class="hero-subtitle mb-4">Discover and connect with educational institutes</p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="stat-item">
                                    <h3 class="stat-number">{{ $institutes->where('status', 1)->count() }}</h3>
                                    <p class="stat-label">Active Institutes</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="stat-item">
                                    <h3 class="stat-number">{{ $institutes->where('mmcertify_verified', true)->where('status', 1)->count() }}</h3>
                                    <p class="stat-label">Verified</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="stat-item">
                                    <h3 class="stat-number">{{ $institutes->pluck('location')->unique()->count() }}</h3>
                                    <p class="stat-label">Locations</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="stat-item">
                                    <h3 class="stat-number">{{ $institutes->where('offered_courses', '!=', null)->where('status', 1)->count() }}</h3>
                                    <p class="stat-label">Course Providers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    <!-- Connection Cards -->
    <div class="row justify-content-center g-4">
        @forelse($institutes->where('status', 1) as $institute)
        <div class="col-md-10">
            <a href="{{ route('connect-hub.show', $institute->id) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="row g-0 h-100">
                    <div class="col-md-2 d-flex align-items-center justify-content-center bg-light p-4">
                        @php
                            $firstImage = null;
                            if($institute->image_gallery && is_array($institute->image_gallery) && count($institute->image_gallery) > 0) {
                                $firstImage = $institute->image_gallery[0];
                            }
                        @endphp
                        
                        @if($institute->company_logo)
                            <div class="institute-image-circle" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid #667eea;">
                                <img src="{{ asset('storage/' . $institute->company_logo) }}" alt="{{ $institute->institute_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-building fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">
                                {{ $institute->institute_name }}
                                @if($institute->mmcertify_verified)
                                    <span class="badge bg-success ms-2"><i class="fas fa-check-circle"></i> Verified</span>
                                @endif
                            </h5>
                            <div class="institute-info">
                                @if($institute->location)
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $institute->location }}</p>
                                @endif
                                @if($institute->phone)
                                    <p class="mb-1"><i class="fas fa-phone text-primary me-2"></i>{{ $institute->phone }}</p>
                                @endif
                                @if($institute->email)
                                    <p class="mb-0"><i class="fas fa-envelope text-primary me-2"></i>{{ $institute->email }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @empty
        <div class="col-md-10">
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">No institutes found</h5>
                <p class="text-muted">Be the first to add a connection!</p>
                <a href="{{ route('connect-hub.create') }}" class="btn btn-modern mt-3">
                    <i class="fas fa-plus me-2"></i>Add First Connection
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
        background: #f8f9fa;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8)), 
                    url('https://images.unsplash.com/photo-1581078426770-6d336e5de7bf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1934&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 2.5rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-icon {
        font-size: 2.5rem;
        color: rgba(255,255,255,0.9);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }

    .hero-title {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1rem;
        font-weight: 400;
        max-width: 500px;
        margin: 0 auto;
    }

    .hero-stats {
        margin-top: 2rem;
    }

    .stat-item {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 10px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-3px);
        background: rgba(255,255,255,0.2);
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }

    .stat-number {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .stat-label {
        color: rgba(255,255,255,0.8);
        font-size: 0.8rem;
        font-weight: 500;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Button Styles */
    .btn-modern {
        background: #ffffff;
        color: #667eea;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        color: #764ba2;
        background: #ffffff;
    }

    /* Card Styles */
    .card {
        transition: all 0.3s ease;
        border: none;
        background: #ffffff;
    }
    
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12) !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        color: #2d3748;
        font-size: 1.25rem;
    }

    .card-text {
        color: #718096;
        font-size: 0.95rem;
    }

    /* Institute Info */
    .institute-info p {
        color: #4a5568;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .institute-info i {
        width: 20px;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        font-weight: 500;
    }

    .institute-image-circle {
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Icon Circle */
    .rounded-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        width: 80px !important;
        height: 80px !important;
    }

    .rounded-circle i {
        font-size: 2rem !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }

        .btn-modern {
            padding: 0.65rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>

           
        </div>
    </div>
</body>

    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
</html>
