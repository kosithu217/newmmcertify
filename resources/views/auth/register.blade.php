<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <!-- Add Font Awesome for the admin icon -->
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
         <style>
            #regtitle{
                border: 1px solid rgba(0,0,0,0.175);
                border-bottom: none;
                margin: 0;
            }
            #regtitle div{
                padding: 0.7rem 0.5rem;
                text-align: center;
                font-size: 0.9em;
                cursor: pointer;
                user-select: none;
            }
            #regtitle div:hover{
                background-color: rgb(83 148 244);
                color: #fff;
            }
            .active{
                background-color: rgba(13,110,253,255) !important;
                color: #fff;
            }
            #regform, #regform2{
                border-radius: 0;
            }
         </style>
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
                <div class="col-md-6">
                    
                    <h6 class="text-center mb-3">Please provide the required information below to create an academic or business institution account for issuing verifiable digital certificates on the MM Certify platform.</h6>
                    
                    <h2 class="text-center mb-4">Account Registration</h2>
                        <div class="row" id="regtitle">
                            <div class="col-12 active">
                                <!--College / University-->
                                Academic or Business Institution
                            </div>
                            <div class="col-6 d-none">
                                Visitor / Employer
                            </div>
                        </div>
                        
                        <div class="card p-3 regform d-none" id="regform">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card p-3 regform mb-5" id="regform2">
                            <form method="POST" action="{{ route('register-uni') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name1" class="form-label">Academic or Business Institution Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name1" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="reg_number" class="form-label">Registration Number (if applicable)</label>
                                    <input type="text" class="form-control @error('reg_number') is-invalid @enderror" id="reg_number" name="reg_number" value="{{ old('reg_number') }}" >
                                    @error('reg_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="contact_name" class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
                                    @error('contact_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Person Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Academic or Business Institution Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required></textarea>
                                    
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email1" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email1" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password1" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation1" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                        
                </div>
            </div>
        </div>
        
        <div id="carouselExampleControls" class="carousel slide d-none" data-bs-ride="carousel">
            <div class="carousel-inner ban">
                
                
                    <div class="carousel-item active">
                        <img src="https://goldious.net/upload/banners/675d2503dc9fb_Grilled%20Duck.png" class="d-block w-100" style="height: 33vw;" alt="Electric Banner Image">
                    </div>
            
                    <div class="carousel-item">
                        <img src="https://goldious.net/upload/banners/675d251b3347c_Mala%20Xioa%20Guo.png" class="d-block w-100" style="height: 33vw;" alt="Electric Banner Image">
                    </div>
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
    </body>

    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            
            // $("#regtitle div").click(function(){
            //     if($(this).hasClass('active')){
            //         return;
            //     }
            //     $("#regtitle div").removeClass('active');
            //     $(this).addClass('active');
            //     $(".regform").toggleClass('d-none');
            // });
                   
        });
    </script>
    
</html>
