@extends('admin.layouts.admin_master')

@section('title')
    Admin : Create
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
@endsection

@section('content')



<div class="container mt-5">
    <div class="row justify-content-center">
        
        <div class="col-12">
            <a href="{{ url('/admin/users') }}" class="btn btn-warning float-end text-white">Back</a>
        </div>
        
        <div class="col-md-6">
                <div class="row" id="regtitle">
                    <div class="col-6 active">
                        College / University
                    </div>
                    <div class="col-6">
                        Visitor / Employer
                    </div>
                </div>
                
                <div class="card p-3 regform d-none" id="regform">
                    <form method="POST" action="{{ route('admin-register') }}">
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
                        <button type="submit" class="btn btn-success w-100 mt-3 py-3">Create</button>
                    </form>
                </div>
                
                <div class="card p-3 regform mb-5" id="regform2">
                    <form method="POST" action="{{ route('admin-register-uni') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name1" class="form-label">Official Registered Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name1" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="reg_number" class="form-label">Company Registration Number</label>
                            <input type="text" class="form-control @error('reg_number') is-invalid @enderror" id="reg_number" name="reg_number" value="{{ old('reg_number') }}" required>
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
                            <label for="address" class="form-label">Physical Address</label>
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
                        <button type="submit" class="btn btn-success w-100 mt-3 py-3">Create</button>
                    </form>
                </div>
                
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('back/js/core/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('back/js/core/popper.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            
            $("#regtitle div").click(function(){
                if($(this).hasClass('active')){
                    return;
                }
                $("#regtitle div").removeClass('active');
                $(this).addClass('active');
                $(".regform").toggleClass('d-none');
            });
                   
        });
    </script>
@endsection

