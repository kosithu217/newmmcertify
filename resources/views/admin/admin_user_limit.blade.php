@extends('admin.layouts.admin_master')

@section('title')
    Admin : Edit Limit
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
                    <div class="col-12 active">
                        Edit Certificate Limit
                    </div>
                </div>
                
                <div class="card p-3 regform mb-5" id="regform2">
                    <form method="POST" action="{{ route('admin.userLimitUpdate') }}">
                        @csrf
                        
                        <input type="hidden" name="id" value="{{ $user->id }}"  />
                        
                        <div class="mb-3">
                            <label for="name1" class="form-label">Official Registered Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name1" name="name" value="{{ $user->name }}" disabled>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email1" name="email" value="{{ $user->email }}" disabled>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="limit" class="form-label">Certificate Limit</label>
                            <input type="number" min="0" class="form-control @error('cert_limit') is-invalid @enderror" value="{{ $user->cert_limit }}" id="limit" name="cert_limit" required>
                            @error('cert_limit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 mt-3 py-3">Update</button>
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
        // $(document).ready(function(){
            
        //     $("#regtitle div").click(function(){
        //         if($(this).hasClass('active')){
        //             return;
        //         }
        //         $("#regtitle div").removeClass('active');
        //         $(this).addClass('active');
        //         $(".regform").toggleClass('d-none');
        //     });
                   
        // });
    </script>
@endsection

