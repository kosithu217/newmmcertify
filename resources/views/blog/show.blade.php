<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }}</title>
    
    <!-- Open Graph Meta Tags for Facebook -->
    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($blog->content), 200) }}" />
    @if($blog->images && count($blog->images) > 0)
    <meta property="og:image" content="{{ asset('storage/certificates/images/' . $blog->images->first()->image_path) }}" />
    @endif
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --accent-color: #f59e0b;
            --text-color: #333;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            color: var(--text-color);
            background-color: #fcfcfc;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        .blog-title {
            font-size: 2.5rem;
            color: #1a202c;
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .blog-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        .meta-info {
            font-size: 0.95rem;
            color: var(--dark-gray);
        }
        
        .meta-info i {
            color: var(--accent-color);
        }
        
        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
            margin: 2rem 0;
        }
        
        .blog-image {
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .featured-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }
        
        .image-caption {
            background-color: rgba(255,255,255,0.9);
            border-radius: 4px;
            padding: 8px 15px;
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-style: italic;
        }
        
        .gallery-image {
            transition: all 0.3s ease;
            height: 220px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .gallery-image:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .gallery-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        
        .gallery-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--medium-gray);
        }
        
        .share-btn {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.3);
        }
        
        .card {
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .navbar {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
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
                <ul style="font-size: 13px;" class="navbar-nav ms-auto">
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article>
                    <h1 class="blog-title">{{ $blog->title }}</h1>
                    <div class="meta-info">
                        <i class="far fa-calendar-alt me-2"></i> {{ $blog->created_at->format('F d, Y') }}
                    </div>
                    
                    <!-- Featured Image from blog table -->
                    @if($blog->featured_image)
                    <div class="my-4 featured-image-container">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}"
                             class="img-fluid blog-image w-100" alt="{{ $blog->title }}">
                        <div class="image-caption">
                            <small><i class="fas fa-camera me-2"></i>{{ $blog->title }}</small>
                        </div>
                    </div>
                    @elseif($images && count($images) > 0)
                    <div class="my-4 featured-image-container">
                        <img src="{{ asset('storage/certificates/images/' . $images->first()->image_path) }}" 
                             class="img-fluid blog-image w-100" alt="{{ $blog->title }}">
                        <div class="image-caption">
                            <small><i class="fas fa-camera me-2"></i>{{ $blog->title }}</small>
                        </div>
                    </div>
                    @endif
                    
                    <div class="blog-content">
                        {!! $blog->body !!}
                    </div>
                    
                    @if($images && count($images) > 0)
                    <div class="mt-5">
                        <h4 class="gallery-title">Photo Gallery</h4>
                        <div class="row g-4">
                            @foreach($images as $image)
                            <div class="col-md-4 mb-4">
                                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank" class="d-block overflow-hidden">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                        class="gallery-image img-fluid w-100" alt="Blog image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Social Share Buttons -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="mb-3"><i class="fas fa-share-alt me-2"></i>Share this post</h5>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           class="share-btn btn btn-primary" target="_blank">
                            <i class="fab fa-facebook-f me-2"></i> Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" 
                           class="share-btn btn btn-info text-white ms-2" target="_blank">
                            <i class="fab fa-twitter me-2"></i> Share on Twitter
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
