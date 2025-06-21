<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $certificate->name }} - Certificate</title>
    <meta name="description" content="View and verify certificate: {{ $certificate->name }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($certificate->logo) }}">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
          
            --accent-color: #2c3e50;
            --light-bg: #f8f9fc;
            --border-color: #e3e6f0;
            --text-muted: #6c757d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        
        .certificate-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin: 2rem auto;
            max-width: 1200px;
            border: 1px solid var(--border-color);
        }
        
        .certificate-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border-bottom: 5px solid var(--accent-color);
        }
        
        .certificate-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
            margin-bottom: 1rem;
        }
        
        .certificate-title {
            margin: 0;
        }
        
        .certificate-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .certificate-body {
            padding: 2.5rem;
        }
        
        .certificate-description {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.7;
        }
        
        .certificate-image {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            margin: 1.5rem 0;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .certificate-image:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        
        .certificate-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .section-title {
            color: var(--accent-color);
            font-weight: 600;
            margin: 2rem 0 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }
        
        .course-outline {
            background: #f8f9fc;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
        }
        
        .attachments-section {
            margin: 2rem 0;
        }
        
        .attachment-badge {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            margin: 0.5rem 0.5rem 0.5rem 0;
            transition: all 0.2s ease;
        }
        
        .attachment-badge:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .attachment-badge i {
            margin-right: 0.5rem;
        }
        
        .back-side-title {
            color: var(--accent-color);
            font-weight: 600;
            margin: 2rem 0 1rem;
            text-align: center;
            position: relative;
        }
        
        .back-side-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--primary-color);
            margin: 0.5rem auto 0;
            border-radius: 3px;
        }
        
        @media (max-width: 768px) {
            .certificate-header {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem 1rem;
            }
            
            .certificate-title {
                margin: 1rem 0 0;
            }
            
            .certificate-body {
                padding: 1.5rem;
            }
            
            .certificate-title h1 {
                font-size: 1.5rem;
            }
        }

    {{--  ======  New Footer Styles V2 ====== --}}
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .container.mt-5 {
            flex-grow: 1;
        }

        /* ---------- Sleek Footer V2 ---------- */
        .sleek-footer {
            position: relative;
            margin-top: 5rem; /* Ensure space above footer */
            padding: 2rem 0; /* Vertical padding for the main footer area */
            background-color: var(--footer-bg-color, #2c3e50); /* Base color, overridden by profile */
            color: var(--footer-text-color, #ffffff); /* Base text color */
            border-top: 4px solid var(--footer-accent-color, #4e6a85); /* Accent border, slightly darker/lighter */
        }

        .sleek-footer .footer-content-wrapper {
            position: relative;
            max-width: 1140px; /* Standard container width */
            margin: 0 auto; /* Center the wrapper */
            padding: 2rem 1.5rem; /* Padding inside the wrapper */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px; /* Rounded corners for the card */
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15); /* Softer shadow */
            border: 1px solid rgba(255, 255, 255, 0.18); /* Subtle border for glass effect */
        }

        .sleek-footer .profile-logo img {
            width: 90px;
            height: 90px;
            border-radius: 50%; /* Circular logo */
            border: 4px solid var(--footer-accent-color, #ffffff);
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .sleek-footer .profile-logo-placeholder {
            width:90px; 
            height:90px; 
            border-radius:50%; 
            background:var(--footer-accent-color);
            display:flex; 
            align-items:center; 
            justify-content:center; 
            margin: 0 auto; /* Center placeholder on mobile */
            border: 4px solid var(--footer-accent-color, #ffffff);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .sleek-footer .profile-logo-placeholder i {
             color: var(--footer-bg-color);
        }

        .sleek-footer .profile-name {
            font-size: 1.85rem;
            font-weight: 700; /* Bolder name */
            margin-bottom: 0.85rem;
            letter-spacing: 0.5px;
        }

        .sleek-footer .profile-details p {
            font-size: 1.05rem; /* Slightly larger detail text */
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            line-height: 1.6;
        }

        .sleek-footer .profile-details i {
            margin-right: 1rem; /* More space for icon */
            font-size: 1.25rem;
            width: 22px; /* Fixed width for icons */
            text-align: center;
            color: var(--footer-accent-color, #ffffff); /* Icon color tied to accent */
        }

        .sleek-footer .profile-details a {
            color: var(--footer-text-color, #ffffff);
            text-decoration: none; /* No underline by default */
            word-break: break-all;
            font-weight: 500; /* Slightly bolder links */
        }

        .sleek-footer .profile-details a:hover {
            text-decoration: underline; /* Underline on hover */
            opacity: 0.85;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .sleek-footer .footer-content-wrapper {
                padding: 1.5rem 1rem;
            }
            .sleek-footer .profile-logo,
            .sleek-footer .profile-logo-placeholder {
                margin-left: auto;
                margin-right: auto;
                margin-bottom: -0.8rem;
            }
            .sleek-footer .profile-name {
                text-align: center;
                font-size: 1.6rem;
            }
            .sleek-footer .profile-details p {
                font-size: 1rem;
                justify-content: flex-start; /* Align text to start on mobile for readability */
            }
            .sleek-footer .profile-details i {
                font-size: 1.15rem;
            }
        }
    </style>
</head>
<body>

    {{-- ================= Certificate Section ================= --}}
    <div class="container py-4">
        <div class="certificate-container">
            <!-- Certificate Header -->
            <div class="certificate-header">
                <img src="{{ asset($certificate->logo) }}" alt="{{ $certificate->name }} Logo" class="certificate-logo">
                <div class="certificate-title">
                    <h1>{{ $certificate->name }}</h1>
                </div>
            </div>
            
            <!-- Certificate Body -->
            <div class="certificate-body">
                <!-- Description -->
                @if($certificate->description)
                    <div class="certificate-description">
                        {!! $certificate->description !!}
                    </div>
                @endif

                <!-- Main Certificate Image -->
                <div class="certificate-image">
                    @if($certificate->certificate_logo)
                        <img src="{{ asset($certificate->certificate_logo) }}" alt="Certificate Front Side" class="img-fluid">
                    @elseif($certificate->certificate)
                        <img src="{{ asset($certificate->certificate) }}" alt="Certificate Front Side" class="img-fluid">
                    @endif
                </div>
                
                <!-- Back Side Certificate Image -->
                @if(!empty($certificate->image_two))
                    <h3 class="back-side-title">Back Side of Certificate</h3>
                    <div class="certificate-image">
                        <img src="{{ asset($certificate->image_two) }}" alt="Certificate Back Side" class="img-fluid">
                    </div>
                @endif

                <!-- Course Outline -->
                @if($certificate->course_outline)
                    <h3 class="section-title">
                        <i class="fas fa-book-open me-2"></i>Course Outline
                    </h3>
                    <div class="course-outline">
                        {!! $certificate->course_outline !!}
                    </div>
                @endif

                <!-- Attachments -->
                @if($certificate->attachments)
                    <h3 class="section-title">
                        <i class="fas fa-paperclip me-2"></i>Supporting Documents
                    </h3>
                    <div class="attachments-section">
                        @foreach (unserialize($certificate->attachments) as $key => $attach)
                            <a href="{{ asset($attach) }}" target="_blank" class="text-decoration-none">
                                <span class="attachment-badge">
                                    <i class="fas fa-file-alt"></i>
                                    Transcript {{ $key+1 }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            </div>
        </div>
    </div>

  
    @php
        // Check if profile exists and has displayable content
        $shouldShowFooter = $profile && (
            !empty($profile->logo) ||
            !empty($profile->phone) ||
            !empty($profile->address) ||
            !empty($profile->weblink)
        );

        // Only calculate colors if we are going to show the footer
        if ($shouldShowFooter) {
            if (!function_exists('getBrightness')) {
                function getBrightness($hexColor) {
                    $hex = str_replace('#', '', $hexColor);
                    if (strlen($hex) == 3) {
                        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
                    }
                    if (strlen($hex) != 6) return 100;
                    
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    return (($r * 0.299) + ($g * 0.587) + ($b * 0.114));
                }
            }

            $footerBgColor = $profile->color ?? '#2c3e50';
            $brightness = getBrightness($footerBgColor);
            $footerTextColor = $brightness > 150 ? '#212529' : '#f8f9fa';
            
            if ($brightness > 200) { 
                $footerAccentColor = '#6c757d'; 
            } elseif ($brightness > 120) { 
                $footerAccentColor = $brightness > 150 ? '#495057' : '#dee2e6'; 
            } else { 
                $footerAccentColor = '#adb5bd'; 
            }
        }
    @endphp

    {{-- Footer section - only shows if there's profile data to display --}}
    @if($shouldShowFooter)
    <footer class="sleek-footer" style="
        --footer-bg-color: {{ $footerBgColor }};
        --footer-text-color: {{ $footerTextColor }};
        --footer-accent-color: {{ $footerAccentColor }};
    ">
        <div class="footer-content-wrapper">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-md-3 text-center text-md-start profile-logo">
                        @if($profile->logo)
                            <img src="{{ asset($profile->logo) }}" alt="{{ $profile->name }}'s Logo">
                        @else
                            <div class="profile-logo-placeholder">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9 profile-details text-center text-md-start">
                        <h3 class="profile-name">{{ $profile->name }}</h3>
                        @if($profile->phone)
                        <p><i class="fas fa-phone-alt"></i> <span>{{ $profile->phone }}</span></p>
                        @endif
                        @if($profile->address)
                        <p style="text-align: justify;"><i class="fas fa-map-marker-alt"></i> <span>{{ $profile->address }}</span></p>
                        @endif
                         @if($profile->weblink)
                            @php
                                $weblink = $profile->weblink;
                                // Add http:// if no protocol is present
                                if (!preg_match('~^(?:f|ht)tps?://~i', $weblink)) {
                                    $weblink = 'http://' . $weblink;
                                }
                            @endphp
                            <p><i class="fas fa-link"></i> <a href="{{ $weblink }}" target="_blank" rel="noopener noreferrer">{{ $profile->weblink }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endif


    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
</body>
</html>