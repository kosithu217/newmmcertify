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
            <div class="col-lg-8">
                <h1 class="hero-title mb-2">Connect Hub</h1>
                <p class="hero-subtitle mb-0">Discover and connect with educational institutes</p>
            </div>
            <div class="col-lg-4 text-lg-end text-center mt-3 mt-lg-0">
                <a href="{{ route('connect-hub.create') }}" class="btn btn-modern">
                    <i class="fas fa-plus me-2"></i>Add Connection
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    <!-- Connection Cards -->
    <div class="row justify-content-center g-4">
        @forelse($institutes as $institute)
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
                        
                        @if($firstImage)
                            <div class="institute-image-circle" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid #667eea;">
                                <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $institute->institute_name }}" style="width: 100%; height: 100%; object-fit: cover;">
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .hero-title {
        color: #ffffff;
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 0.95rem;
        font-weight: 400;
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
