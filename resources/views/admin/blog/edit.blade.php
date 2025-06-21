@extends('admin.layouts.admin_master')

@section('title')
    Admin : Dashboard
@endsection

@section('content')
<div class="container-fluid py-4">
<!-- Form start moved inside card body -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Edit Blog Post</h6>
                        <div class="pe-3">
                            <a href="{{ route('admin.blog') }}" class="btn btn-sm btn-info mb-0">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="input-group input-group-static mb-4">
                                    <label>Blog Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static mb-4">
                                    <label for="status" class="ms-0">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" {{ old('status', $blog->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $blog->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label class="ms-0">Featured Image</label>
                                    @if($blog->featured_image)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                    @endif
                                    <div class="form-control p-2 border">
                                        <input type="file" name="featured_image" class="form-control-file @error('featured_image') is-invalid @enderror">
                                    </div>
                                    <small class="text-muted">Recommended size: 1200x800 pixels</small>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label class="ms-0">Additional Images (Multiple)</label>
                                    <div class="form-control p-2 border">
                                        <input type="file" name="images[]" class="form-control-file" multiple>
                                    </div>
                                    <small class="text-muted">You can select multiple images</small>
                                </div>
                            </div>
                        </div>

                        @if(isset($images) && count($images) > 0)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="fw-bold mb-3">Current Additional Images</label>
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <div class="card-body p-2">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}" class="img-fluid rounded mb-2">
                                                        <button type="button" class="btn btn-danger btn-sm w-100 delete-image-btn" data-image-id="{{ $image->id }}" data-token="{{ csrf_token() }}">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="input-group input-group-static mb-4">
                            <label>Blog Content</label>
                            <textarea id="blog-editor" name="body" class="form-control @error('body') is-invalid @enderror" rows="12">{{ old('body', $blog->body) }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.blog') }}" class="btn btn-light me-3">Cancel</a>
                            <button type="submit" class="btn bg-gradient-primary">Update Blog Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto hide alert messages after 3 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.display = 'none';
        });
    }, 3000);
    
    // Handle image deletion via AJAX
    document.querySelectorAll('.delete-image-btn').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = this.getAttribute('data-image-id');
                const token = this.getAttribute('data-token');
                const imageCard = this.closest('.col-md-3');
                
                // Create a form dynamically
                const form = document.createElement('form');
                form.style.display = 'none';
                form.method = 'POST';
                form.action = '{{ url("/admin/blog/image") }}/' + imageId;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = token;
                form.appendChild(csrfToken);
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                
                document.body.appendChild(form);
                
                console.log('Submitting to URL:', form.action);
                
                // Submit the form
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        // Remove the image card from the DOM
                        imageCard.remove();
                        
                        // Show success message
                        const successAlert = document.createElement('div');
                        successAlert.className = 'alert alert-success alert-dismissible fade show';
                        successAlert.innerHTML = 'Image deleted successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        
                        const alertContainer = document.querySelector('.card-body');
                        alertContainer.insertBefore(successAlert, alertContainer.firstChild);
                        
                        // Auto hide the alert after 3 seconds
                        setTimeout(() => {
                            successAlert.style.display = 'none';
                        }, 3000);
                    } else {
                        alert('Failed to delete image. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
                
                document.body.removeChild(form);
            }
        });
    });
});
</script>
@endpush
@endsection
