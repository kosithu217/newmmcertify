<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('nav')

    <style>
      /* Full background image like register page */
      body {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
      }
      body::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("{{ asset('uri_ifs___M_k8o0SNw4dgbLNtQIQhXcgDGtRdDqrLY-BrlYIYsO-Ek.webp') }}") center/cover no-repeat;
        opacity: 0.12; /* subtle backdrop */
        z-index: -1;
      }
      /* Page background and layout */
      .verify-hero { 
        min-height: calc(100vh - 140px);
        padding: 40px 0 80px; 
        background: transparent; /* reveal body background image */
      }
      .lead-intro { max-width: 780px; margin: 0 auto 14px; color: #2c3e50; text-align: center; }
      .lead-intro p { margin-bottom: 10px; }

      /* Verification card */
      .verify-card { 
        max-width: 560px; 
        margin: 24px auto 28px; 
        background-color: #1877F2;
        border-radius: 18px; 
        padding: 28px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        color: #fff;
      }
      .verify-card label { color: rgba(255,255,255,0.9); font-weight: 600; font-size: 12px; letter-spacing: .3px; }
      .verify-input.form-control { 
        border-radius: 999px; 
        background: rgba(255,255,255,0.95); 
        border: none; 
        height: 44px; 
        padding-left: 16px; 
      }
      .verify-input.form-control:focus { box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.35); }
      .verify-btn { 
        background-color: #e8c98f; 
        color:#333; 
        border-radius: 999px; 
        border: none; 
        padding: 10px 28px; 
        font-weight: 600; 
      }
      .verify-btn:hover { background-color:#dbb971; color:#333; }
    </style>

    <section class="verify-hero">
      <div class="container">
        @session('error')
          <div class="text-center">{!! session('error') !!}</div>
        @endsession

        <div class="lead-intro">
          <p>
            MM Certify ensures the authenticity of digital certificates issued by our partner academic and business institutions,
            providing seamless verification for learners, employers and recruiters.
          </p>
          <p>
            To verify the authenticity of the certificate, please enter the required details below.
          </p>
        </div>

        <div class="verify-card">
          <form method="POST" action="{{ url('/search') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Enter the name of the education or business institution on the certificate</label>
              <input type="text" class="form-control verify-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="number" class="form-label">Enter the certificate ID</label>
              <input type="number" class="form-control verify-input @error('number') is-invalid @enderror" id="number" name="number" required>
              @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="text-center">
              <button type="submit" class="verify-btn">Submit</button>
            </div>
          </form>
        </div>

        <div class="lead-intro">
          <p>
            Beyond verification, MM Certify and our partners help learners to showcase their memorable course achievements,
            making their qualifications stand out.
          </p>
        </div>
      </div>
    </section>
           
        </div>
    </div>
</body>

    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
</html>
