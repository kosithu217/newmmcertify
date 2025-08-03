<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .blog-card {
            transition: transform 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .title {
            color: #344767;
            font-weight: bolder;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <img src="{{ asset('mmlogo.jpg') }}" style="height: 100px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul  style="font-size: 13px;" class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-primary ms-4" href="{{ url('/') }}">Home</a>
                    </li>
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
                        <a class="nav-link text-primary ms-4 active" href="{{ route('blog.index') }}">Blog</a>
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Blog Posts Section -->
    <div class="container mt-5">
        <h1 class="title mb-5 text-center">Blog Posts</h1>
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 blog-card">
                    @if($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                class="card-img-top" alt="{{ $blog->title }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
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
                                <a href="{{ route('blog.show', ['id' => $blog->id]) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No blog posts available yet.</h3>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>About Us</h5>
                    <p>MM Certify is a verifiable e-certificate issuing platform tailored specifically for educational and business institution in Myanmar and Thailand, ensuring the authenticity and credibility of educational qualifications.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                        <li><a href="{{ url('/#about-us') }}" class="text-white">About Us</a></li>
                        <li><a href="{{ url('/#product-service') }}" class="text-white">Services</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Yangon, Myanmar</li>
                        <li><i class="fas fa-phone me-2"></i> 09 799 263 405</li>
                        <li><i class="fas fa-envelope me-2"></i> info@mmcertify.com</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; {{ date('Y') }} MM Certify. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
