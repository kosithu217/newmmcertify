<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">

    <title>

        @yield('title')

    </title>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('/back/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/back/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->

    <link id="pagestyle" href="{{ asset('/back/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />

    <!-- Beautiful Mobile Menu CSS -->
    <style>
        /* Mobile Menu Toggle Button */
        .mobile-menu-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .mobile-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .mobile-menu-btn:active {
            transform: translateY(0);
        }

        .hamburger-line {
            width: 22px;
            height: 2px;
            background: white;
            margin: 2px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .mobile-menu-btn:hover .hamburger-line:nth-child(1) {
            transform: translateY(1px);
        }

        .mobile-menu-btn:hover .hamburger-line:nth-child(3) {
            transform: translateY(-1px);
        }

        /* Mobile Navbar Styling */
        #navbarBlur {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 10px;
        }

        @media (max-width: 1199.98px) {
            .sidenav {
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                z-index: 1050;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }
            
            .sidenav.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                padding-top: 20px;
            }

            /* Mobile overlay */
            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .mobile-overlay.show {
                opacity: 1;
                visibility: visible;
            }

            /* Close button styling */
            #closeSidenav {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            #closeSidenav:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }
        }
        
        @media (min-width: 1200px) {
            .sidenav {
                transform: translateX(0) !important;
            }
        }

        /* Animation for menu opening */
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .sidenav.animate-in {
            animation: slideInLeft 0.4s ease-out;
        }
    </style>

    @yield('css')


</head>


<body class="g-sidenav-show  bg-gray-100">


    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">

        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-xl-none"
                aria-hidden="true" id="closeSidenav"></i>
            <a class="navbar-brand m-0" href="{{ url('/') }}" target="_blank">
                <img src="{{ asset('/mmlogo.jpg') }}" class="navbar-brand-img" style="max-height: 70px;" alt="main_logo">
            </a>
        </div>


        <hr class="horizontal light mt-0 mb-2">

        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">

                @if(auth()->user()->hasMenuPermission('dashboard'))
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                @endif
                
                @if(auth()->user()->hasMenuPermission('users'))
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/users') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">College & Employer</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasMenuPermission('blog'))
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/blog') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">article</i>
                        </div>
                        <span class="nav-link-text ms-1">Blog</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasMenuPermission('certificates'))
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/certificates') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Certificates</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->hasMenuPermission('admin_management'))
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin.admin-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">admin_panel_settings</i>
                        </div>
                        <span class="nav-link-text ms-1">Admin Management</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>

        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn bg-gradient-danger mt-4 w-100" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>

    </aside>

    <main class="main-content border-radius-lg">
        <!-- Beautiful Mobile Menu Toggle -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-lg border-radius-xl d-xl-none bg-white" id="navbarBlur">
            <div class="container-fluid py-3 px-4">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <button class="mobile-menu-btn d-xl-none" type="button" id="mobileMenuToggle">
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                            <span class="hamburger-line"></span>
                        </button>
                        <div class="ms-3">
                            <h6 class="mb-0 font-weight-bold text-dark">Admin Panel</h6>
                            <p class="text-sm mb-0 text-muted">Dashboard</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('/mmlogo.jpg') }}" class="navbar-brand-img" style="max-height: 40px;" alt="MM Certify">
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>


    <!--   Core JS Files   -->
    <script src="{{ asset('/back/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/back/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/back/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/back/js/plugins/smooth-scrollbar.min.js') }}"></script>


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        // Beautiful Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const closeSidenav = document.getElementById('closeSidenav');
            const sidenav = document.getElementById('sidenav-main');
            const body = document.body;

            // Create mobile overlay
            const mobileOverlay = document.createElement('div');
            mobileOverlay.className = 'mobile-overlay';
            mobileOverlay.id = 'mobileOverlay';
            body.appendChild(mobileOverlay);

            // Toggle mobile menu
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidenav.style.transform = 'translateX(0)';
                    sidenav.style.visibility = 'visible';
                    sidenav.classList.add('animate-in');
                    mobileOverlay.classList.add('show');
                    body.style.overflow = 'hidden';
                });
            }

            // Close mobile menu function
            function closeMobileMenu() {
                sidenav.style.transform = 'translateX(-100%)';
                sidenav.classList.remove('animate-in');
                mobileOverlay.classList.remove('show');
                body.style.overflow = '';
            }

            // Close mobile menu
            if (closeSidenav) {
                closeSidenav.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileMenu();
                });
            }

            // Close menu when clicking overlay
            mobileOverlay.addEventListener('click', function() {
                closeMobileMenu();
            });

            // Close menu when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 1200) {
                    if (!sidenav.contains(event.target) && 
                        !mobileMenuToggle.contains(event.target) && 
                        !event.target.closest('#navbarBlur')) {
                        closeMobileMenu();
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1200) {
                    sidenav.style.transform = '';
                    sidenav.style.visibility = '';
                    sidenav.classList.remove('animate-in');
                    mobileOverlay.classList.remove('show');
                    body.style.overflow = '';
                }
            });

            // Close menu when clicking on menu items (mobile)
            const menuLinks = sidenav.querySelectorAll('.nav-link');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1200) {
                        setTimeout(() => {
                            closeMobileMenu();
                        }, 300);
                    }
                });
            });
        });
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/back/js/material-dashboard.min.js?v=3.0.4') }}"></script>

    @yield('js')
</body>

</html>
