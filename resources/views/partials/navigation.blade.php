<!-- Modern Navigation -->
<nav class="navbar navbar-expand-lg fixed-top modern-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('mmlogo.jpg') }}" style="height: 80px;" alt="MM Certify Logo" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                        
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About Us
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ url('/#about-us') }}">About Us</a></li>
                        <li><a class="dropdown-item" href="{{ url('/#vision-mission') }}">Vision & Mission</a></li>
                        <li><a class="dropdown-item" href="{{ url('/#core-values') }}">Core Values</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#product-service') }}">Services</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#users-benefits') }}">Benefits</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#faqs') }}">FAQs</a>
                </li>
                    
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-modern ms-2 px-3" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    
                    @hasrole('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin') }}">
                                <i class="fas fa-cogs me-1"></i> Admin
                            </a>
                        </li>
                    @elsehasrole('user')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/user') }}">
                                <i class="fas fa-cogs me-1"></i> Dashboard
                            </a>
                        </li>
                    @endhasrole
                
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
                
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary ms-2 px-3" href="{{ url('/check') }}">
                        <i class="fas fa-search me-1"></i> Verify
                    </a>
                </li>
                    
            </ul>
        </div>
    </div>
</nav>