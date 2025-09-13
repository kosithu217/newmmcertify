@extends(Auth::user()->hasRole('user') ? 'admin.layouts.master' : 'admin.layouts.admin_master')

@section('title')
    Edit Profile
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white" style="
    background-color: #434390 !important;
">
                    <h3  style="
    color: white;
" class="mb-0">Edit Profile</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control bg-white border @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $profile->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control bg-white border @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control bg-white border @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $profile->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color bg-white border @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $profile->color ?? '#000000') }}" title="Choose your color">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control bg-white border @error('logo') is-invalid @enderror" id="logo" name="logo">
                            @if($profile->logo)
                                <div class="mt-2">
                                    <img src="{{ asset($profile->logo) }}" alt="Current Logo" width="80">
                                    <span class="text-muted small ms-2">Current Logo</span>
                                </div>
                            @endif
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-white border @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $profile->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="weblink" class="form-label">Weblink</label>
                            <input type="text" class="form-control bg-white border @error('weblink') is-invalid @enderror" id="weblink" name="weblink" value="{{ old('weblink', $profile->weblink) }}">
                            @error('weblink')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <button style="
    background-color: #434390;
" type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
