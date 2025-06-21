<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            
            @session('success')
                <p class="text-white text-center py-3 mb-3 bg-success">{{ session('success') }}</p>
            @endsession
            
            <div class="col-md-6">
                <h2 class="text-center mb-4">Reset Password</h2>
                <form method="POST" action="{{ route('reset-password') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                    
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
