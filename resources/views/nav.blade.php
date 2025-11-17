<style>
    /* Menu text style */
    .navbar-nav .nav-link {
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 11px;
    }

    /* Pill buttons like demo image */
    .btn-pill-primary {
        background-color: #4f6cff; /* blue */
        color: #fff !important;
        border-radius: 999px;
        padding: 6px 14px;
        border: none;
        font-weight: 600;
        line-height: 1.2;
    }
    .btn-pill-primary:hover { background-color: #3c57db; color:#fff !important; }

    .btn-pill-warning {
        background-color: #e8c98f; /* beige */
        color: #333 !important;
        border-radius: 999px;
        padding: 6px 14px;
        border: none;
        font-weight: 600;
        line-height: 1.2;
    }
    .btn-pill-warning:hover { background-color: #dbb971; color:#333 !important; }
    /* Show default caret for About Us (removed previous hide rule) */
    /* Logo sizing */
    .navbar-brand img { height: 100px; }

    /* Mobile tweaks */
    @media (max-width: 991.98px) {
        .navbar-nav .nav-link { padding: 10px 0; }
        .navbar-nav .nav-item { margin-bottom: 6px; }
        .auth-actions { display: flex; gap: 10px; align-items: center; }
        .auth-actions .btn { display: inline-flex; align-items: center; }
        .navbar-brand img { height: 72px; }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ asset('mmlogo.png') }}" style="height: 63px;" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mmNavbar" aria-controls="mmNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mmNavbar">
                    <ul  style="font-size: 13px;" class="navbar-nav ms-auto">
                        
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link text-primary ms-4" href="#">About Us</a>-->
                        <!--</li>-->
                        
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle text-primary" href="#" id="aboutUsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutUsDropdown">
                                <li><a class="dropdown-item" href="{{ url('/#about-us') }}">About Us</a></li>
                                <li><hr class="dropdown-divider"></li>
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
                            <a class="nav-link text-primary ms-4" href="{{ url('/connect-hub') }}">Connect Hub</a>
                        </li>



                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link text-primary ms-4" href="{{ route('blog.index') }}">Blog Post</a>-->
                        <!--</li>-->
                        
                        <li class="nav-item">
                            <a class="nav-link text-primary ms-4" href="{{ url('/#faqs') }}">FAQs</a>
                        </li>
                            
                        @guest
                            <li class="nav-item auth-actions ms-4">
                                <a class="btn btn-pill-primary" href="{{ route('register') }}" style="font-size: 11px;">Sign Up</a>
                                <a class="btn btn-pill-warning" href="{{ route('login') }}" style="font-size: 11px;">Sign In</a>
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
<!-- Rely on page/layout Bootstrap JS include to avoid duplicates -->
<script>
  // Add top padding equal to navbar height so content isn't hidden
  (function() {
    const applyOffset = () => {
      const nav = document.querySelector('nav.navbar');
      if (!nav) return;
      document.body.style.paddingTop = nav.offsetHeight + 'px';
    };
    window.addEventListener('load', applyOffset);
    window.addEventListener('resize', () => setTimeout(applyOffset, 50));
    // Recalculate when navbar collapses/expands (height changes)
    document.addEventListener('shown.bs.collapse', applyOffset);
    document.addEventListener('hidden.bs.collapse', applyOffset);
  })();
</script>
<script>
// Smooth scroll for same-page anchors and home anchors
document.addEventListener('click', function(e) {
  const link = e.target.closest('a[href]');
  if (!link) return;
  const href = link.getAttribute('href');
  if (!href) return;

  // Extract hash if present
  const hashIndex = href.indexOf('#');
  if (hashIndex === -1) return; // no anchor target

  const hash = href.slice(hashIndex); // like '#about-us'

  // If link is a pure hash OR it's a home URL with hash and we are already on home, smooth-scroll
  const isPureHash = href.startsWith('#');
  const isHomeHash = href.includes('/#') && window.location.pathname === '/';
  if (isPureHash || isHomeHash) {
    const target = document.querySelector(hash);
    if (target) {
      e.preventDefault();
      const offset = 100; // space for fixed navbar
      const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  }
});
</script>