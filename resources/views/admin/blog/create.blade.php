@extends('admin.layouts.admin_master')

@section('title')
    Admin : Dashboard
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Create New Blog Post</h6>
                        <div class="pe-3">
                            <a href="{{ route('admin.blog') }}" class="btn btn-sm btn-info mb-0">Back to List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="input-group input-group-static mb-4">
                                    <label>Blog Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static mb-4">
                                    <label for="status" class="ms-0">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label class="ms-0">Featured Image</label>
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

                        <div class="input-group input-group-static mb-4">
                            <label>Blog Content</label>
                            <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="8" required>{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.blog') }}" class="btn btn-light me-3">Cancel</a>
                            <button type="submit" class="btn bg-gradient-primary">Create Blog Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
