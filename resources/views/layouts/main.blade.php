<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://mmcertify.com/storage/certificates/logos/mmcertify.png">
    <title>@yield('title', 'MM Certify - Certificate Verification Platform')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    <!-- Modern Styles -->
    <style>
        * {
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        body, html {
            height: 100%;
            margin: 0;
            background-color: #ffffff;
            color: #2c3e50;
            line-height: 1.7;
        }

        /* Modern White-Based Design */
        
        /* Navigation Styles */
        .modern-navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .modern-navbar .navbar-brand img {
            transition: transform 0.3s ease;
        }
        
        .modern-navbar .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        .modern-navbar .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            padding: 0.8rem 1.2rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .modern-navbar .nav-link:hover {
            color: #3498db !important;
            background: rgba(52, 152, 219, 0.08);
            transform: translateY(-1px);
        }
        
        /* Button Styles */
        .btn-modern {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            color: #ffffff;
            padding: 0.8rem 2.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
            color: #ffffff;
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .dropdown-item {
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
        
        /* Main Content */
        .main-content {
            margin-top: 100px;
        }

        /* Smooth scrolling for anchor links */
        html { scroll-behavior: smooth; }
        /* Offset so content isn't hidden under the fixed navbar */
        section[id] { scroll-margin-top: 100px; }
        
        @yield('styles')
    </style>
    
    @yield('additional-styles')
</head>
<body>
    <!-- Navigation -->
    @include('partials.navigation')
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
    @yield('scripts')
</body>
</html>