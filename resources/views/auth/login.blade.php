<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar bg-primary -->
    @include('nav')
    
    <style>
      /* Full background image like register/check pages */
      body { min-height: 100vh; position: relative; overflow-x: hidden; }
      body::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("{{ asset('uri_ifs___M_k8o0SNw4dgbLNtQIQhXcgDGtRdDqrLY-BrlYIYsO-Ek.webp') }}") center/cover no-repeat;
        opacity: 0.12; /* subtle backdrop */
        z-index: -1;
      }
      .login-hero { min-height: calc(100vh - 120px); display: flex; align-items: center; padding: 40px 0; }
      .login-card {
        max-width: 520px; 
        margin: 0 auto; 
        background-color: #1877F2;
         color: #fff;
        border-radius: 18px; box-shadow: 0 20px 50px rgba(0,0,0,0.2); padding: 28px;
      }
      .login-title { font-weight: 700; font-size: 22px; text-align: center; margin-bottom: 18px; }
      .login-label { color: rgba(255,255,255,0.92); font-weight: 600; font-size: 12px; letter-spacing: .3px; }
      .login-input.form-control { border-radius: 999px; background: #fff; border: none; height: 44px; padding-left: 16px; }
      .login-input.form-control:focus { box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.35); }
      .login-btn { background: #e8c98f; color: #333; border: none; border-radius: 999px; padding: 10px 18px; font-weight: 700; width: 100%; }
      .login-btn:hover { background: #dbb971; color: #333; }
      .login-links a { color: #fff; opacity: .95; text-decoration: none; font-size: 13px; }
      .login-links a:hover { text-decoration: underline; }
    </style>

    <section class="login-hero">
      <div class="container">
        <div class="row justify-content-center">
          @session('success')
            <p class="text-white text-center py-2 mb-3 bg-success">{{ session('success') }}</p>
          @endsession

          <div class="col-12 col-md-8 col-lg-6">
            <div class="login-card">
              <h2 class="login-title">Log in</h2>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                  <label for="email" class="login-label form-label">Email</label>
                  <input type="email" class="form-control login-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="login-label form-label">Password</label>
                  <input type="password" class="form-control login-input @error('password') is-invalid @enderror" id="password" name="password" required>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="remember" name="remember">
                  <label class="form-check-label" for="remember" style="color: rgba(255,255,255,0.9)">Remember Me</label>
                </div>
                <button type="submit" class="login-btn">Log in</button>
                <div class="mt-3 text-center login-links">
                  <a href="{{ route('register') }}">Don't have an account? Register</a>
                </div>
                <div class="mt-2 text-center login-links">
                  <a href="{{ route('reset') }}">Reset Password</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>

    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
</html>
