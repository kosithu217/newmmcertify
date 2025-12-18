<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $institute->institute_name }} - Connect Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('nav')

    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('connect-hub') }}">Connect Hub</a></li>
                <li class="breadcrumb-item active">{{ $institute->institute_name }}</li>
            </ol>
        </nav>

        <!-- Institute Header -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if($institute->company_logo)
                            <div class="institute-logo">
                                <img src="{{ asset('storage/' . $institute->company_logo) }}" alt="{{ $institute->institute_name }}">
                            </div>
                        @else
                            <div class="institute-logo-placeholder">
                                <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <h1 class="h2 mb-2">{{ $institute->institute_name }}</h1>
                        @if($institute->mmcertify_verified)
                            <p class="text-success mb-2">
                                <i class="fas fa-check-circle me-1"></i> MMCertify Verified
                            </p>
                        @endif
                        @if($institute->location)
                            <p class="text-muted mb-1">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $institute->location }}
                            </p>
                        @endif
                        <!-- <a href="#" class="text-primary text-decoration-none">
                            <i class="fas fa-map me-1"></i>View on Google Maps
                        </a> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-6">
                <!-- Short Overview -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Short Overview</h5>
                        <p class="text-muted">{{ $institute->short_overview }}</p>
                    </div>
                </div>

                <!-- Offered Courses -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Offered Courses</h5>
                        @if($institute->offered_courses && is_array($institute->offered_courses))
                            @foreach($institute->offered_courses as $course)
                                <div class="course-item mb-3 pb-3 border-bottom">
                                    <h6 class="mb-1">{{ $course['name'] ?? 'N/A' }}</h6>
                                    <p class="text-muted small mb-0">{{ $course['duration'] ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No courses available</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                <!-- Certificate Showcase -->
                @if($institute->certificate_showcase)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Certificate Showcase</h5>
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $institute->certificate_showcase) }}" 
                                 alt="Certificate" 
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 300px;">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Job Opportunities -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Job Opportunities</h5>
                        @if($institute->job_opportunities && is_array($institute->job_opportunities) && count($institute->job_opportunities) > 0)
                            <ul class="list-unstyled">
                                @foreach($institute->job_opportunities as $job)
                                    @if($job)
                                        <li class="mb-2"><i class="fas fa-briefcase text-primary me-2"></i>{{ $job }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No job opportunities available</p>
                        @endif
                    </div>
                </div>

                <!-- Contact -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Contact</h5>
                        @if($institute->website)
                            <p class="mb-2">
                                <i class="fas fa-globe text-primary me-2"></i>
                                <a href="{{ $institute->website }}" target="_blank" class="text-decoration-none">{{ $institute->website }}</a>
                            </p>
                        @endif
                        @if($institute->phone)
                            <p class="mb-2">
                                <i class="fas fa-phone text-primary me-2"></i>{{ $institute->phone }}
                            </p>
                        @endif
                        @if($institute->email)
                            <p class="mb-2">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:{{ $institute->email }}" class="text-decoration-none">{{ $institute->email }}</a>
                            </p>
                        @endif
                        <!-- <p class="mb-0">
                            <i class="fab fa-facebook text-primary me-2"></i>
                            <a href="#" class="text-decoration-none">Facebook</a>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        @if($institute->image_gallery && is_array($institute->image_gallery) && count($institute->image_gallery) > 0)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-3">Image Gallery</h5>
                <div class="row g-3">
                    @foreach($institute->image_gallery as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery Image" 
                                 class="img-fluid rounded shadow-sm gallery-img">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <style>
        body {
            background: #f8f9fa;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #667eea;
        }

        .institute-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #667eea;
        }

        .institute-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .institute-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }

        .course-item:last-child {
            border-bottom: none !important;
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }

        .gallery-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        .card-title {
            color: #2d3748;
            font-weight: 600;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
